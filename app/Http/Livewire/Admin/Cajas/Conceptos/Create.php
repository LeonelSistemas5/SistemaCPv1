<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Cajas\Conceptos;

use App\Http\Livewire\Base;
use App\Models\Concepto;
use Illuminate\Contracts\View\View;

class Create extends Base
{
    public $denominacion = '';
    public $precio = '';

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
        return view('livewire.admin.cajas.conceptos.create');
    }

    public function store(): void
    {
        $this->validate();

        $concepto = Concepto::create([
            'denominacion' => $this->denominacion,
            'precio' => $this->precio
        ]);

        add_user_log([
            'title'        => 'Cargo nuevo registrado '.$this->denominacion,
            'link'         => route('admin.cajas.conceptos', ['concepto' => $concepto->id]),
            'reference_id' => $concepto->id,
            'section'      => 'Conceptos',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.cajas.conceptos.conceptos','alert','Concepto creado satisfactoriamente');
        
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
