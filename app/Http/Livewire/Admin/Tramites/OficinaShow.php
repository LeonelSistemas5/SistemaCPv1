<?php

namespace App\Http\Livewire\Admin\Tramites;

use App\Models\Oficina;
use Livewire\Component;
use App\Http\Livewire\Base;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;
use function abort_if_cannot;
use function view;
class OficinaShow extends base
{
    use WithPagination;

    public    $denominacion      = '';
    public    $precio            = '';

    public    $paginate   = '';
    public    $search       = '';
    public    $sortField  = 'id';
    public    $sortAsc    = false;
    protected $listeners  = ['alert' => 'alert'];

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

    public function render(): view
    {
        return view('livewire.admin.tramites.oficina-show');
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
        return Oficina::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function oficinas()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('denominacion', 'like', '%'.$this->search.'%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $concepto = $this->builder()->findOrFail($id);
        $this->denominacion = $concepto->denominacion;
        $this->precio = $concepto->precio;
    }

    public function update($id): void
    {
        $this->validate();
        $this->builder()->findOrFail($id)->update([
            'denominacion' => $this->denominacion
        ]);
        
        add_user_log([
            'title'        => 'Concepto actualizado '.$this->denominacion,
            'link'         => route('admin.cajas.conceptos', ['concepto' => $id]),
            'reference_id' => $id,
            'section'      => 'Conceptos',
            'type'         => 'updated'
        ]);

        flash('Concepto actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_concepto');

        $this->builder()->findOrFail($id)->delete();

        add_user_log([
            'title'        => 'Concepto eliminado '.$this->denominacion,
            'link'         => route('admin.cajas.conceptos', ['concepto' => $id]),
            'reference_id' => $id,
            'section'      => 'Conceptos',
            'type'         => 'deleted'
        ]);

        flash('Concepto eliminado satisfactoriamente')->error();
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cleanModal(): void
    {
        $this->denominacion = '';
        $this->precio = '';
    }
}