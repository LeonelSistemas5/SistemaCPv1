<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pagos(){
        return $this->belongsToMany('App\Models\Pago');
    }
}
