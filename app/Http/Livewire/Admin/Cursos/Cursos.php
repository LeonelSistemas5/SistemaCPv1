<?php

namespace App\Http\Livewire\Admin\Cursos;

use App\Http\Livewire\Base;
use App\Models\Curso;
use App\Models\Inscripcione;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

use function abort_if_cannot;
use function view;

class Cursos extends Base
{
    use WithPagination;

    public $denominacion = '';
    public $precio_certificado = '';
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $temario = '';
    public $estado = '';

    public $paginate = '';
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = true;
    protected $listeners  = ['alert' => 'alert'];

    protected array $rules = [
        'denominacion' => 'required|string|max:191',
        'precio_certificado' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'temario' => 'required',
        'estado' => 'required'
    ];

    protected array $messages = [
        'denominacion.required' => 'La denominación es requerida',
        'denominacion.max' => 'La denominación no debe exceder de 191 caracteres',

        'precio_certificado.required' => 'El precio es requerida',
        'fecha_inicio.required' => 'La fecha de inicio es requerida',
        'fecha_fin.required' => 'La fecha de fin es requerida',
        'temario.required' => 'El temario es requerida',
        'estado.required' => 'El estado es requerida',
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
        return view('livewire.admin.cursos.index');
    }

    public function updating(): void
    {
        $this->resetPage();
    }

    public function alert($alert): void
    {
        flash($alert);
        $this->render();
    }

    public function builder()
    {
        return Curso::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function cursos()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('denominacion', 'like', '%' . $this->search . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $curso = $this->builder()->findOrFail($id);
        $this->denominacion = $curso->denominacion;
        $this->precio_certificado = $curso->precio_certificado;
        $this->fecha_inicio = Carbon::parse($curso->fecha_inicio)->format('Y-m-d');
        $this->fecha_fin = Carbon::parse($curso->fecha_fin)->format('Y-m-d');
        $this->temario = $curso->temario;
        $this->estado = $curso->estado;
    }

    public function update($id): void
    {
        $this->validate();
        $this->builder()->findOrFail($id)->update([
            'denominacion' => $this->denominacion,
            'precio_certificado' => $this->precio_certificado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'temario' => $this->temario,
            'estado' => $this->estado,
        ]);

        add_user_log([
            'title'        => 'Curso actualizado ' . $this->denominacion,
            'link'         => route('admin.cursos.index', ['curso' => $id]),
            'reference_id' => $id,
            'section'      => 'Cursos',
            'type'         => 'updated'
        ]);

        flash('Curso actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_curso');

        $this->builder()->findOrFail($id)->delete();

        add_user_log([
            'title'        => 'Curso eliminado ' . $this->denominacion,
            'link'         => route('admin.cursos.index', ['curso' => $id]),
            'reference_id' => $id,
            'section'      => 'Cursos',
            'type'         => 'deleted'
        ]);

        flash('Curso eliminado satisfactoriamente')->error();
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cleanModal(): void
    {
        $this->denominacion = '';
        $this->precio_certificado = '';
        $this->temario = '';
    }
}
