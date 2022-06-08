<?php

namespace App\Http\Livewire\Soal;

use App\Models\Mapel;
use Livewire\Component;

class Tmbhsoalessai extends Component
{
    public $soalId, $action;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
        // dd($this->i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(Mapel $soalId)
    {
        $this->soalId = $soalId;
        // dd($soalId);
    }

    public function render()
    {
        return view('livewire.soal.tmbhsoalessai');
    }
}
