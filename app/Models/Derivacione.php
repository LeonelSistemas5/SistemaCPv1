<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derivacione extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tramite(){
        return $this->belongsTo('App\Models\Tramite');
    }

    public function oficina_origen(){
        return $this->belongsTo('App\Models\Oficina','oficina_origen','id');
    }

    public function oficina_destino(){
        return $this->belongsTo('App\Models\Oficina','oficina_destino','id');
    }
}
