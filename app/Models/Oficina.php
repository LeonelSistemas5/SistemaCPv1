<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function seguimientos_origen(){
        return $this->hasMany('App\Models\Derivacione','oficina_origen','id');
    }

    public function seguimientos_destino(){
        return $this->hasMany('App\Models\Derivacione','oficina_destino','id');
    }
}
