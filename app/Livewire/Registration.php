<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Registration extends Component
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users,email',
            'password' => 'required|min:3',
        ];
    }

    public function save()
    {
        $this->validate();

        User::insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        return redirect()->to('/login');
    }

    public function render()
    {
        return view('livewire.registration')->extends('layouts.app');
    }
}
