<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\Capitulos;

use App\Http\Livewire\Base;
use App\Models\Capitulo;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;

use function abort_if_cannot;
use function view;

class Capitulos extends Base
{
    use WithPagination;

    public    $denominacion      = '';

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

    public function render(): View
    {
        return view('livewire.admin.colegios.capitulos.index');
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
        return Capitulo::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function capitulos()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('denominacion', 'like', '%'.$this->search.'%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $this->denominacion = $this->builder()->findOrFail($id)->denominacion;
    }

    public function update($id): void
    {
        $this->validate();
        $this->builder()->findOrFail($id)->update([
            'denominacion' => $this->denominacion
        ]);
        
        add_user_log([
            'title'        => 'Capítulo actualizado '.$this->denominacion,
            'link'         => route('admin.colegios.capitulos', ['capítulo' => $id]),
            'reference_id' => $id,
            'section'      => 'Capítulos',
            'type'         => 'updated'
        ]);

        flash('Capítulo actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_cargo');

        $this->builder()->findOrFail($id)->delete();

        add_user_log([
            'title'        => 'Capítulo eliminado '.$this->denominacion,
            'link'         => route('admin.colegios.capitulos', ['capitulo' => $id]),
            'reference_id' => $id,
            'section'      => 'Capítulos',
            'type'         => 'deleted'
        ]);

        flash('Capítulo eliminado satisfactoriamente')->error();
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
