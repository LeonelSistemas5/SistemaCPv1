<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function intentos(){
        return $this->hasMany('App\Models\Intento');
    }
}
