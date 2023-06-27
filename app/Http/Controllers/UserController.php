<?php

namespace App\Http\Controllers;

use App\Mail\AccountUpdatedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $numberOfOpenPots = $user->pots->count();

        $totalContributions = 0;
        $totalContributionsValue = 0;
        $finishedPots = 0;
        $openPots = $user->pots->where('status', 'open')->count();

        foreach ($user->pots as $pot) {
            $totalContributions += $pot->transactions->count();
            if ($pot->amount >= $pot->goal) {
                $finishedPots++;
            }
            foreach ($pot->transactions as $transaction) {
                if ($transaction->addition_or_withdrawal == 'add') {
                    $totalContributionsValue += $transaction->amount;
                }
            }
        }

        return Inertia::render('User/Edit', [
            'user' => Auth::user(),
            'numberOfOpenPots' => $numberOfOpenPots,
            'totalContributions' => $totalContributions,
            'totalContributionsValue' => $totalContributionsValue,
            'openPots' => $openPots,
            'finishedPots' => $finishedPots,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $input = $request->validate([
            'name' => 'sometimes',
            'email' => 'sometimes',
            'password' => 'sometimes',
        ]);

        if ($request->hasFile('profile_photo_path')) {
            $input['profile_photo_path'] = $request->profile_photo_path->store('Images', 'public');
        } else {
            $input['profile_photo_path'] = $user->profile_photo_path;
        }

        if ($input['password'] !== null) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $user->password;
        }

        Mail::to($user->email)->send(new AccountUpdatedEmail());
        $user->update($input);

        return redirect()->back();
    }
}
