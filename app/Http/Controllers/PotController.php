<?php

namespace App\Http\Controllers;

use App\Mail\AddMoneyToPotEmail;
use App\Mail\ClosingPotEmail;
use App\Mail\CreatePotEmail;
use App\Mail\SuccessfulCompletedPot;
use App\Mail\SuccessfulWithdrawlFromPotEmail;
use App\Mail\UnSuccessfulWithdrawlFromPotEmail;
use App\Mail\UpdatedPotEmail;
use App\Models\Pot;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use URL;

class PotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pots = auth()->user()->pots()->get();

        return Inertia::render('Pots/Index', ['userPots' => $pots]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pot  $pot
     * @return \Illuminate\Http\Response
     */
    public function show(Pot $pot)
    {
        if ($pot->is_private == 1) {
            if ($this->userCanManage($pot)) {
                return Inertia::render('Pots/Show', [
                    'pot' => $pot,
                    'contributors' => $pot->transactions()->with('user')->orderBy('created_at', 'DESC')->get(),
                    'user' => Auth(),
                    'userCanManage' => $this->userCanManage($pot),
                    'base_url' => URL::to(''),
                ]);
            } else {
                return redirect()->back();
            }
        } else {
            return Inertia::render('Pots/Show', [
                'pot' => $pot,
                'contributors' => $pot->transactions()->with('user')->orderBy('created_at', 'DESC')->get(),
                'user' => Auth(),
                'userCanManage' => $this->userCanManage($pot),
                'base_url' => URL::to(''),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Pots/Create', ['user_id' => Auth()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->is_auto_closing === true ? 1 : 0;
        $input = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'is_private' => 'required',
            'description' => '',
            'amount' => '',
            'goal' => '',
            'status' => '',
            'cover_photo_path' => ['nullable', 'mimes:jpg,jpeg,png,jpeg,gif,svg'],
            'accent_colour' => '',
            'is_auto_closing' => '',
        ]);

        if ($request->hasFile('cover_photo_path')) {
            $input['cover_photo_path'] = $request->cover_photo_path->store('Images', 'public');
        } else {
            $input['cover_photo_path'] = 'Images/login_main.jpg';
        }

        Pot::create($input);
        $user = auth()->user();
        Mail::to($user->email)->send(new CreatePotEmail());

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pot  $pot
     * @return \Illuminate\Http\Response
     */
    public function edit(Pot $pot)
    {
        return Inertia::render('Pots/Edit', [
            'pot' => $pot,
            'user' => Auth(),
            'base_url' => URL::to(''),
            'userCanCloseAndWithdraw' => $this->userCanCloseAndWithdraw($pot),
        ]);
    }

    private function userCanManage(Pot $pot)
    {
        $admins = $pot->administrators->pluck('user_id');
        $userHasAdminPermission = $admins->contains(function ($value, $key) {
            return $value === Auth::id();
        });
        $userCreatedThePot = $pot->user_id == Auth::id();

        if ($userCreatedThePot || $userHasAdminPermission) {
            return true;
        } else {
            return false;
        }
    }

    private function userCanCloseAndWithdraw(Pot $pot)
    {
        $userCreatedThePot = $pot->user_id == Auth::id();

        if ($userCreatedThePot) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pot  $pot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pot $pot)
    {
        if ($this->userCanManage($pot)) {
            $request->is_auto_closing === true ? 1 : 0;
            $input = $request->validate([
                'name' => 'required',
                'is_private' => 'required',
                'description' => '',
                'goal' => '',
                'accent_colour' => '',
                'is_auto_closing' => '',
            ]);

            if ($request->hasFile('cover_photo_path')) {
                $input['cover_photo_path'] = $request->cover_photo_path->store('Images', 'public');
            } else {
                $input['cover_photo_path'] = $pot->cover_photo_path;
            }
            $pot->update($input);
            $user = auth()->user();
            Mail::to($user->email)->send(new UpdatedPotEmail());

            return redirect()->back();
        }
    }

    public function destroy(Pot $pot)
    {
        $pot->update(['status' => 'closed']);
        $user = auth()->user();
        Mail::to($user->email)->send(new ClosingPotEmail());

        return redirect()->back();
    }

    public function unsuspend(Pot $pot)
    {
        $pot->update(['status' => 'open']);

        return redirect()->back();
    }

    public function makeTransaction(Request $request)
    {
        $pot = new Pot($request['pot']);
        $method = $request['method'];
        $input = $request->validate([
            'amount' => 'required',
            'reference' => '',
        ]);

        if (Auth::id()) {
            $input['user_id'] = Auth::id();
        } else {
            if (User::find(99999)) {
                $input['user_id'] = 99999;
            } else {
                $user = User::Create([
                    'id' => 99999,
                    'name' => 'Guest Contributer',
                    'email' => 'guest@moneypot.co.uk',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => 'asdfghjklm',
                    'profile_photo_path' => '/Images/login_main.jpg',
                ]);
                $input['user_id'] = $user->id;
            }
        }

        $input['pot_id'] = $pot->id;
        $input['addition_or_withdrawal'] = $method;
        $user = auth()->user();

        if ($method == 'add') {
            if ($pot->is_auto_closing == 1 && ($pot->amount + $input['amount']) >= $pot->goal) {
                DB::table('pots')
                    ->where('id', $pot->id)
                    ->update([
                        'amount' => $pot->amount += $input['amount'],
                        'status' => 'closed',
                    ]);
                $potAuthor = User::where('id', $pot->user_id)->first();
                Mail::to($potAuthor->email)->send(new SuccessfulCompletedPot());
                Transaction::create($input);
            } else {
                DB::table('pots')
                    ->where('id', $pot->id)
                    ->update(['amount' => $pot->amount += $input['amount']]);
                Transaction::create($input);
            }

            if ($user) {
                Mail::to($user->email)->send(new AddMoneyToPotEmail());
            }

            return redirect()->back();
        } elseif ($method == 'withdraw' && $this->userCanCloseAndWithdraw($pot)) {
            if ($pot->amount - $input['amount'] >= 0) {
                $pot->decrement('amount', $input['amount']);
                Transaction::create($input);
                Mail::to($user->email)->send(new SuccessfulWithdrawlFromPotEmail());
            } else {
                Mail::to($user->email)->send(new UnsuccessfulWithdrawlFromPotEmail());
            }
        } else {
            return redirect()->back();
        }

        return redirect()->back();
    }
}
