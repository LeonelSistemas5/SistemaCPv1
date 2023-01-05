<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Curso;

class Curso_ extends Component
{
    public Curso $curso;
    public User $user;

    public function render()
    {
        return view('livewire.curso_');
    }
    public function builder()
    {
        return Curso::where('curso_id', $this->curso->id);
    }
    public function cursos()
    {
        $query = $this->builder();

        return $query;
    }
}
