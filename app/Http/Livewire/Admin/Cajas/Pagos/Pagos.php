<?php

namespace App\Http\Livewire\Admin\Cajas\Pagos;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;

class Pagos extends Base
{
    public function render(): View
    {
        return view('livewire.admin.cajas.pagos.index');
    }
}
