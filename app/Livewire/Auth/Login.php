<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username = '10521003'; // Default
    public $password = '10521003'; // Default
    public $remember;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function login()
    {
        $this->validate();
        try {
            $credentials = [
                'username' => $this->username,
                'password' => $this->password,
            ];
            if (Auth::guard('web')->attempt($credentials, $this->remember)) {
                session()->regenerate();
                return $this->dispatch('alert', ["title" => "SUCCESS", "message" => "Login berhasil mohon tunggu...!", 'type' => 'success', 'reload' => true]);
            }
            return $this->dispatch('alert', ["title" => "ERROR", "message" => "Username atau password salah!", 'type' => 'error']);
        } catch (\Throwable $th) {
            return $this->dispatch('alert', ["title" => "ERROR", "message" => "Login error: " . $th->getMessage(), 'type' => 'error']);
        }
    }
}
