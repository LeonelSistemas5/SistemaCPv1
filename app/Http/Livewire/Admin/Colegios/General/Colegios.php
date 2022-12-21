<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\General;

use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;

class Colegios extends Base
{
    public function render(): View
    {
        return view('livewire.admin.colegios.general.index');
    }
}
