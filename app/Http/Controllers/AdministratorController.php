<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Pot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use URL;

class AdministratorController extends Controller
{
    private function userCanManage(Pot $pot)
    {
        $userCreatedThePot = $pot->user_id == Auth::id();
        if ($userCreatedThePot) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pot $pot)
    {
        if ($this->userCanManage($pot)) {
            $admins = User::select('email')
                ->join('administrators', 'administrators.user_id', '=', 'users.id')
                ->where('administrators.pot_id', $pot->id)
                ->distinct()
                ->get();

            return Inertia::render('Administrators/Create', [
                'pot' => $pot,
                'administrators' => $admins->pluck('email'),
                'base_url' => URL::to(''),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pot $pot)
    {
        if ($this->userCanManage($pot)) {
            $request->validate([
                'email' => 'required',
                'pot_id' => 'required',
            ]);

            $user = User::where('email', $request['email'])->first();
            if ($user) {
                $request['user_id'] = $user->id;
                Administrator::create($request->all());

                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
    }

    public function destroy(POT $pot, User $user)
    {
        if ($this->userCanManage($pot)) {
            $admin = Administrator::where('user_id', $user->id)->where('pot_id', $pot->id)->first();
            $admin->delete();

            return redirect()->back();
        }
    }
}
