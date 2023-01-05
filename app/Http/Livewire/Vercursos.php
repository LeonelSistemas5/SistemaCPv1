<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Curso;

class Vercursos extends Component
{
    public function render()
    {
        return view('livewire.vercursos');
    }
    public function builder()
    {
        return Curso::all();
    }
    public function cursos()
    {
        $query = $this->builder();

        return $query;
    }
}
