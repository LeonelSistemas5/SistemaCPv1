<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users\Edit;

use App\Http\Livewire\Base;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

use function add_user_log;
use function flash;
use function is_admin;
use function view;

class AdminSettings extends Base
{
    public User $user;
    public      $isOfficeLoginOnly;
    public      $isActive;
    public      $roleSelections = [];
    protected   $listeners      = ['refreshAdminSettings' => 'mount'];

    public function mount(): void
    {
        $this->isActive          = (int) $this->user->is_active;
        $this->isOfficeLoginOnly = (int) $this->user->is_office_login_only;
    }

    public function render(): View
    {
        $users = User::get();

        return view('livewire.admin.users.edit.admin-settings', compact('users'));
    }

    protected function rules(): array
    {
        return [
            'isOfficeLoginOnly' => 'integer',
            'isActive'          => 'integer'
        ];
    }

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

        if (is_admin()) {
            $this->user->is_office_login_only = $this->isOfficeLoginOnly ? 1 : 0;
            $this->user->is_active            = $this->isActive ? 1 : 0;

            add_user_log([
                'title'        => "updated ".$this->user->name."'s admin settings",
                'reference_id' => $this->user->id,
                'link'         => route('admin.users.edit', ['user' => $this->user->id]),
                'section'      => 'Users',
                'type'         => 'Update'
            ]);
        }

        $this->user->save();

        flash('App Settings Updated!')->success();
        $this->emit('refreshProfile');
    }
}
