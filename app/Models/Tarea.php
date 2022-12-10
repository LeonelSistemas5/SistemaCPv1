<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function intentos(){
        return $this->hasMany('App\Models\Intento');
    }
}
