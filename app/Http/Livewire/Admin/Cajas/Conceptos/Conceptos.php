<?php

namespace App\Http\Livewire\Admin\Cajas\Conceptos;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;

class Conceptos extends Base
{
    public function render(): View
    {
        return view('livewire.admin.cajas.conceptos.conceptos');
    }
}
