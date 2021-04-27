<?php

namespace App\Http\Livewire;

use App\Http\Services\DepositionService;
use App\Models\Deposition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DepositionList extends Component
{

    public $depositions;

    public function mount()
    {
        $this->depositions = Auth::user()->depositions;
    }

    public function load()
    {
        $service = new DepositionService();
        $service->load();
        $this->depositions = Auth::user()->depositions;
    }

    public function render()
    {
        return view('livewire.deposition-list');
    }
}
