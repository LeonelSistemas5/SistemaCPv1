<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\General;

use App\Http\Livewire\Base;
use App\Models\Colegio;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;

use function add_user_log;
use function flash;
use function view;

class Edit extends Base
{
    use WithFileUploads;

    public $ruc = '';
    public $razon_social = '';
    public $email = '';

    public function mount(): void
    {
        $this->ruc = Colegio::where('id', 1)->value('ruc');
        $this->razon_social = Colegio::where('id', 1)->value('razon_social');
        $this->email = Colegio::where('id', 1)->value('email');
    }

    public function render(): View
    {
        return view('livewire.admin.colegios.general.edit');
    }

    public function rules(): array
    {
        return [
            'ruc' => 'required|max:11|min:11',
            'razon_social' => 'required|max:100',
            'email' => 'required|max:45',
        ];
    }

    protected array $messages = [
        'ruc.required' => 'El ruc es requerido',
        'ruc.max' => 'El ruc debe contener 11 digitos',
        'ruc.min' => 'El ruc debe contener 11 digitos',
        'razon_social.required' => 'La razón social es requerido',
        'razon_social.max' => 'La razón social no debe exeder de 100 caracteres',
        'email.required' => 'El email es requerido',
        'email.max' => 'El email no debe exeder de 45 caracteres'
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    
    public function update(): void
    {
        $this->validate();

        Cache::flush();
        Colegio::updateOrCreate(['id' => 1], [
            'ruc' => $this->ruc,
            'razon_social' => $this->razon_social,
            'email' => $this->email
        ]);

        add_user_log([
            'title'        => 'Datos del colegio actualizados',
            'link'         => route('admin.colegios.general'),
            'reference_id' => auth()->id(),
            'section'      => 'Colegios',
            'type'         => 'Update'
        ]);

        flash('!Los datos del colegio se actualizaron satisfactoriamente!')->success();
    }
}
