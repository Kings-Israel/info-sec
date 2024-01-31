<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'phone_number' => ['required', 'unique:users'],
        ]);

        $newUser = User::create($request->all() + ['password' => Hash::make($request->input('phone_number'))]);

        return redirect()->route('users')->with('success', 'User added successfully, Use Phone Number as the default password ');
    }
    public function resend($id)
    {
        $user = User::find($id);
        $pdf = PDF::loadView('barcode', ['guest' => $user]);
        SendMail::dispatchAfterResponse($user, $pdf->output());
        return redirect()->route('success', $user->id);
    }
}
