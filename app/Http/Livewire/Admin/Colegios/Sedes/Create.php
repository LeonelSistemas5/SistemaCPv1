<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\Sedes;

use App\Http\Livewire\Base;
use App\Models\Sede;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

use function add_user_log;
use function view;

class Create extends Base
{
    public    $denominacion      = '';
    public    $direccion = '';
    public    $telefono = '';
    public    $celular = '';

    protected array $rules = [
        'denominacion' => 'required|string|max:191',
        'direccion' => 'max:191',
        'telefono' => 'max:15',
        'celular' => 'max:9|min:9'
    ];

    protected array $messages = [
        'denominacion.required' => 'La denominación es requerida',
        'denominacion.max' => 'La denominación no debe exeder de 191 caracteres',
        'direccion.max' => 'La direccion no debe exeder de 191 caracteres',
        'telefono.max' => 'El teléfono no debe exeder de 15 caracteres',
        'celular.max' => 'El celular debe contener 9 caracteres',
        'celular.min' => 'El celular debe contener 9 caracteres'
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
        return view('livewire.admin.colegios.sedes.create');
    }

    public function store(): void
    {
        $this->validate();

        $sede = Sede::create([
            'denominacion' => $this->denominacion,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'celular' => $this->celular
        ]);

        add_user_log([
            'title'        => 'Sede nueva registrado '.$this->denominacion,
            'link'         => route('admin.colegios.sedes', ['sede' => $sede->id]),
            'reference_id' => $sede->id,
            'section'      => 'Sedes',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.colegios.sedes.sedes','alert','Sede creada satisfactoriamente');
        
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
