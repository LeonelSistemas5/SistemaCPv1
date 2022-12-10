<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inscripcione(){
        return $this->belongsTo('App\Models\Inscripcione');
    }

    public function tarea(){
        return $this->belongsTo('App\Models\Tarea');
    }

    public function documentos(){
        return $this->hasMany('App\Models\Documento');
    }
}
