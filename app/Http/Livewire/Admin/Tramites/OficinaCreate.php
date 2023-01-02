<?php

namespace App\Http\Livewire\Admin\Tramites;

use App\Http\Livewire\Base;
use App\Models\Concepto;
use App\Models\Oficina;
use Illuminate\Contracts\View\View;

class OficinaCreate extends Base
{
    public $denominacion = '';
    protected array $rules = [
        'denominacion' => 'required|string|max:191'
    ];

    protected array $messages = [
        'denominacion.required' => 'La denominación es requerida',
        'denominacion.max' => 'La denominación no debe exceder de 191 caracteres'
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): View
    {
        return view('livewire.admin.tramites.oficina-create');
    }

    public function store(): void
    {
        $this->validate();

        $concepto = Oficina::create([
            'denominacion' => $this->denominacion
        ]);

        add_user_log([
            'title'        => 'Cargo nuevo registrado '.$this->denominacion,
            'link'         => route('admin.tramites.oficina', ['concepto' => $concepto->id]),
            'reference_id' => $concepto->id,
            'section'      => 'Conceptos',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.tramites.oficina-show','alert','Oficina creado satisfactoriamente');
        
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
