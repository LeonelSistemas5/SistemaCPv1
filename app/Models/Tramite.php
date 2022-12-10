<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tramitetipo(){
        return $this->belongsTo('App\Models\Tramitetipo');
    }

    public function colegiado(){
        return $this->belongsTo('App\Models\Tramitetipo');
    }

    public function derivaciones(){
        return $this->hasMany('App\Models\Derivacione');
    }

    public function documentos(){
        return $this->hasMany('App\Models\Documento');
    }
}
