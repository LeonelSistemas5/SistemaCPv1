<?php

namespace App\Http\Livewire\Admin\Colegios;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;

class Colegios extends Base
{
    public function render(): View
    {
        return view('livewire.admin.colegios.index');
    }
}
