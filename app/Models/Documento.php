<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tramite(){
        return $this->belongsTo('App\Models\Tramite');
    }

    public function intento(){
        return $this->belongsTo('App\Models\Intento');
    }
}
