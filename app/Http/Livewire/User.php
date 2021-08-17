<?php

namespace App\Http\Livewire;

use App\Models\User as AllUsers;
use App\Models\Admin;
use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return view('livewire.user',  [
            'users' => AllUsers::all(),
        ]);
    }
}
