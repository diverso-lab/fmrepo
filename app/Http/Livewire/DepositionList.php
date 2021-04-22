<?php

namespace App\Http\Livewire;

use App\Models\Deposition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DepositionList extends Component
{

    //public $depositions = Auth::user()->depositions;
    public $prueba = 'antes';

    public function load()
    {

        $this->prueba = 123456;
        $this->pruea = 'despues';

        //var_dump($depositions);
    }

    public function render()
    {
        return view('livewire.deposition-list');
    }
}
