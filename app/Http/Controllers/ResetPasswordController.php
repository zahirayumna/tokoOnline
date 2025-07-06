<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    //
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'emailreset' => 'required|email|exists:user,email',

        ], [
            'emailreset.required' => 'Email tidak boleh kosong.',
            'emailreset.exists' => 'Email harus terdaftar.',
            'emailreset.email' => 'Email harus valid.'
        ]);

        $status = Password::sendResetLink(['email' => $request->emailreset]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('statusMail', __($status))
            : back()->withErrors(['emailreset' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('backend.v_login.resetpass', [
            'judul' => 'Login',
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if ($record && Hash::check($request->token, $record->token)) {
            // Token is valid → proceed to reset password
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->save();
                }
            );

            return redirect()->route('backend.login')->with('statusMail', __($status));
        } else {
            return redirect()->back()->withErrors(['password' => [__('Reset token is invalid')]]);
        }

    }
}
