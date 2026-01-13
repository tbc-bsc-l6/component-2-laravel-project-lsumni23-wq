<?php

namespace App\Livewire;

use Livewire\Component;

class RegisterUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);


        $user = \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Illuminate\Support\Facades\Hash::make($this->password),
            'user_role_id' => \App\Models\UserRole::where('role', 'student')->value('id'),
        ]);

        auth()->login($user);
        session()->flash('message', 'User registered successfully!');
        return redirect()->route('splash');
    }

    public function render()
    {
        return view('livewire.register-user');
    }
}
