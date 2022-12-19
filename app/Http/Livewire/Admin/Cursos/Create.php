<?php

namespace App\Http\Livewire\Admin\Cursos;

use App\Http\Livewire\Base;
use App\Models\Curso;
use Illuminate\Contracts\View\View;

class Create extends Base
{
    public $denominacion = '';
    public $precio_certificado = '';
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $temario = '';

    protected array $rules = [
        'denominacion' => 'required|string|max:191',
        'precio_certificado' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'temario' => 'required',
    ];

    protected array $messages = [
        'denominacion.required' => 'La denominación es requerida',
        'denominacion.max' => 'La denominación no debe exceder de 191 caracteres',

        'precio_certificado.required' => 'El precio es requerida',
        'fecha_inicio.required' => 'La fecha de inicio es requerida',
        'fecha_fin.required' => 'La fecha de fin es requerida',
        'temario.required' => 'El temario es requerida',
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
        return view('livewire.admin.cursos.create');
    }

    public function store(): void
    {
        $this->validate();

        $curso = Curso::create([
            'denominacion' => $this->denominacion,
            'precio_certificado' => $this->precio_certificado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'temario' => $this->temario,
            'modelo_certificado' => 'test',
            'estado' => '0',
            'capitulo_id' => '1'
        ]);

        add_user_log([
            'title'        => 'Cargo nuevo registrado ' . $this->denominacion,
            'link'         => route('admin.cursos.index', ['curso' => $curso->id]),
            'reference_id' => $curso->id,
            'section'      => 'Cursos',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.cursos.cursos', 'alert', 'Concepto creado satisfactoriamente');

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
