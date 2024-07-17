<?php
declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            'email' => 'required|min:3',
            'password' => 'required|min:3',
        ];
    }

    public function save()
    {
        $this->validate();

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->to('/loan/dashboard');
        }

        return back()->withErrors(['email' => 'email or password is wrong']);
    }

    public function render()
    {
        return view('livewire.login')->extends('layouts.app');
    }
}
