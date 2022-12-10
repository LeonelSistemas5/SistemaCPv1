<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramitetipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requisitos(){
        return $this->belongsToMany('App\Models\Requisito');
    }

    public function tramites(){
        return $this->hasMany('App\Models\Tramite');
    }
}
