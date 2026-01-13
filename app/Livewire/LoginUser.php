<?php

namespace App\Livewire;

use Livewire\Component;

class LoginUser extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        session()->flash('error', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.login-user');
    }
}
