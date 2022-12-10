<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tramitetipos(){
        return $this->belongsToMany('App\Models\Tramitetipo');
    }
}
