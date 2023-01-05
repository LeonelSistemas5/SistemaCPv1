<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Curso;
use function auth;
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
    // public function inscribir($curso){
    //     // if(isset(Auth::User())){
    //     //     redirect("/curso_//$curso");
    //     // }
    //     dd($curso);
    //     return redirect("/login");
    // }
}
