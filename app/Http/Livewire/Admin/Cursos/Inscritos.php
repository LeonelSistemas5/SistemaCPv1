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

class Inscritos extends Base
{
    use WithPagination;

    public Curso $curso;

    public $idCurso = '';

    // public $codigo = '';
    // public $asistencia = 0;
    // public $nota_final = 0;
    public $rol_curso = '';

    public $paginate = '';
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = false;
    protected $listeners  = ['alert' => 'alert'];

    protected array $rules = [
        'rol_curso' => 'required',
    ];

    protected array $messages = [
        'rol_curso.required' => 'El rol_curso es requerida',
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): view
    {
        return view('livewire.admin.cursos.inscritos');
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
        return Inscripcione::where('curso_id', $this->curso->id)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function inscritos()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('codigo', 'like', '%' . $this->search . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function curso()
    {
        return $this->curso;
    }

    // public function usuarios()
    // {
    //     $a = Inscripcione::select(
    //         "users.name",
    //     )
    //         ->rightJoin("users", "users.id", "=", "inscripciones.user_id")
    //         ->where('inscripciones.id', "=", null)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    //         // ->where('inscripciones.id', "=", null)
    //         // ->get();
    //     // dd($a);
    //     if ($this->search) {
    //         $a->where('name', 'like', '%' . $this->search . '%');
    //     }
    //     // dd($this->search);
    //     return $a;
    // }

    public function edit($id): void
    {
        $incripcion = $this->builder()->findOrFail($id);
        $this->rol_curso = $incripcion->rol_curso;
    }

    public function update($id): void
    {
        $this->validate();
        $this->builder()->findOrFail($id)->update([
            'rol_curso' => $this->rol_curso == '0' ? '1' : '0',
        ]);

        // add_user_log([
        //     'title'        => 'Inscripción actualizada ' . $this->rol_curso,
        //     'link'         => route('admin.cursos.inscritos', ['inscritos' => $id]),
        //     'reference_id' => $id,
        //     'section'      => 'inscritos',
        //     'type'         => 'updated'
        // ]);
        flash('Se cambio de rol de satisfactoriamente')->success();

        // dd("ds");
        // $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_inscrito');

        $this->builder()->findOrFail($id)->delete();

        // add_user_log([
        //     'title'        => 'Curso eliminado ' . $this->denominacion,
        //     'link'         => route('admin.cursos.index', ['curso' => $id]),
        //     'reference_id' => $id,
        //     'section'      => 'Cursos',
        //     'type'         => 'deleted'
        // ]);

        flash('Se eliminó correctamente un participante.')->error();
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cleanModal(): void
    {
        $this->rol_curso = '';
    }
}
