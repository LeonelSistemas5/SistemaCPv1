<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function capitulo(){
        return $this->belongsTo('App\Models\Capitulo');
    }

    public function cursoinscripciones(){
        return $this->hasMany('App\Models\Cursoinscripcione');
    }

    public function tareas(){
        return $this->hasMany('App\Models\Tarea');
    }
}
