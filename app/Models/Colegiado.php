<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegiado extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function capitulo(){
        return $this->belongsTo('App\Models\Capitulo');
    }

    public function tramites(){
        return $this->hasMany('App\Models\Tramite');
    }

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
