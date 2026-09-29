<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|string',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your Email or Matrimony ID.',
        ]);

        $input = trim($this->email);
        $attemptEmail = $input;

        if (! filter_var($input, FILTER_VALIDATE_EMAIL)) {
            // Check if it is a Matrimony ID (e.g. MZ000042, MZ42, 42)
            if (preg_match('/^(?:MZ)?0*(\d+)$/i', $input, $matches)) {
                $user = \App\Models\User::find((int) $matches[1]);
                if ($user) {
                    $attemptEmail = $user->email;
                }
            }
        }

        if (Auth::attempt(['email' => $attemptEmail, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            if (in_array(Auth::user()->role, ['admin', 'moderator'])) {
                return redirect()->intended('/stnapanel');
            }

            return redirect()->intended(route('browse'));
        }

        $this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.app', ['title' => 'Log In - MeroZodi']);
    }
}
