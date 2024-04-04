<?php

// app/Http/Livewire/ProfilePrivacy.php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfilePrivacy extends Component
{
    public $isPrivate;

    public function mount()
    {
        $this->isPrivate = Auth::user()->private;
    }

    public function updatedIsPrivate($value)
    {
        Auth::user()->update(['private' => $value]);
    }

    public function render()
    {
        return view('livewire.profile-privacy');
    }
}

