<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function colegiados(){
        return $this->hasMany('App\Models\Colegiado');
    }

    public function cursos(){
        return $this->hasMany('App\Models\Curso');
    }
}
