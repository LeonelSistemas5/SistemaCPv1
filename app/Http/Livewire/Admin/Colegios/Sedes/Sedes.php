<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\Sedes;

use App\Http\Livewire\Base;
use App\Models\Sede;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;

use function abort_if_cannot;
use function view;

class Sedes extends Base
{
    use WithPagination;

    public    $denominacion      = '';
    public    $direccion = '';
    public    $telefono = '';
    public    $celular = '';

    public    $paginate   = '';
    public    $search       = '';
    public    $sortField  = 'id';
    public    $sortAsc    = false;
    protected $listeners  = ['alert' => 'alert'];

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
        return view('livewire.admin.colegios.sedes.index');
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
        return Sede::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function sedes()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('denominacion', 'like', '%'.$this->search.'%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $sede = $this->builder()->findOrFail($id);

        $this->denominacion = $sede->denominacion;
        $this->direccion = $sede->direccion;
        $this->telefono = $sede->telefono;
        $this->celular = $sede->celular;
    }

    public function update($id): void
    {
        $this->validate();
        $this->builder()->findOrFail($id)->update([
            'denominacion' => $this->denominacion,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'celular' => $this->celular
        ]);
        
        add_user_log([
            'title'        => 'Sede actualizado '.$this->denominacion,
            'link'         => route('admin.colegios.sedes', ['sede' => $id]),
            'reference_id' => $id,
            'section'      => 'Sedes',
            'type'         => 'updated'
        ]);

        flash('Sede actualizada satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_sede');

        $this->builder()->findOrFail($id)->delete();

        add_user_log([
            'title'        => 'Sede eliminada '.$this->denominacion,
            'link'         => route('admin.colegios.sedes', ['sede' => $id]),
            'reference_id' => $id,
            'section'      => 'Sedes',
            'type'         => 'deleted'
        ]);

        flash('Sede eliminada satisfactoriamente')->error();
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
