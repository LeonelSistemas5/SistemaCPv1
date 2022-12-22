<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Colegios\General;

use App\Http\Livewire\Base;
use App\Models\Colegio;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

use function add_user_log;
use function flash;
use function view;


class Logo extends Base
{
    use WithFileUploads;

    public $colegioLogo             = '';
    public $existingColegioLogo     = '';
    public $colegioLogoDark         = '';
    public $existingColegioLogoDark = '';

    public function mount(): void
    {
        parent::mount();

        $this->existingColegioLogo     = Colegio::where('id', 1)->value('logo');
        $this->existingColegioLogoDark = Colegio::where('id', 1)->value('logo_dark');
    }

    protected function rules(): array
    {
        return [
            'colegioLogo'     => 'image|mimes:png,jpg,gif|max:5120',
            'colegioLogoDark' => 'image|mimes:png,jpg,gif|max:5120'
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.colegios.general.logo');
    }

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * @throws Exception
     */
    public function update(): void
    {
        $this->validate();

        Cache::flush();

        if ($this->colegioLogo !== '') {
            $colegioLogo = Colegio::where('logo', 1)->value('logo');
            if ($colegioLogo !== null) {
                Storage::disk('public')->delete($colegioLogo);
            }

            $token = md5(random_int(1, 10).microtime());
            $name  = $token.'.png';
            $img   = Image::make($this->colegioLogo)->encode('png')->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();

            Storage::disk('public')->put('logo/'.$name, $img);
            Colegio::updateOrCreate(['id' => 1], ['logo' => 'logo/'.$name]);
        }

        if ($this->colegioLogoDark !== '') {
            $colegioLogoDark = Colegio::where('id', 1)->value('logo_dark');
            if ($colegioLogoDark !== null) {
                Storage::disk('public')->delete($colegioLogoDark);
            }

            $token = md5(random_int(1, 10).microtime());
            $name  = $token.'.png';
            $img   = Image::make($this->colegioLogoDark)->encode('png')->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();

            Storage::disk('public')->put('logo/'.$name, $img);
            Colegio::updateOrCreate(['id' => 1], ['logo_dark' => 'logo/'.$name]);
        }

        add_user_log([
            'title'        => 'Logo del colegio actualizado',
            'link'         => route('admin.colegios.general'),
            'reference_id' => auth()->id(),
            'section'      => 'Colegios',
            'type'         => 'Update'
        ]);

        flash('!El logo del colegio se actualizó satisfactoriamente!')->success();
    }
}
