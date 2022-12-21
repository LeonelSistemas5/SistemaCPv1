<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\Capitulos;

use App\Http\Livewire\Base;
use App\Models\Capitulo;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

use function add_user_log;
use function view;

class Create extends Base
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
        return view('livewire.admin.colegios.capitulos.create');
    }

    public function store(): void
    {
        $this->validate();

        $capitulo = Capitulo::create([
            'denominacion' => $this->denominacion,
        ]);

        add_user_log([
            'title'        => 'Capítulo nuevo registrado '.$this->denominacion,
            'link'         => route('admin.colegios.capitulos', ['capitulo' => $capitulo->id]),
            'reference_id' => $capitulo->id,
            'section'      => 'Capítulos',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.colegios.capitulos.capitulos','alert','Capítulo creado satisfactoriamente');
        
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
