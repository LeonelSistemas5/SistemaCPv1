<div wire:poll>
    <x-2col>
        <x-slot name="left">
            <h3>Autenticación de dos factores</h3>

            @if (auth()->user()->two_fa_active == 'No')
                <p>Agregue seguridad adicional a su cuenta mediante la autenticación de dos factores.</p>

                <p><b>¿Por qué necesito esto?</b></p>

                <p>Las contraseñas pueden ser robadas, especialmente si usa la misma contraseña para varios sitios.
                Agregar la verificación en dos pasos significa que, incluso si le roban la contraseña, su cuenta permanecerá segura.</p>

                <p><b>¿Como funciona?</b></p>

                <p>Después de activar la Verificación en dos pasos para su cuenta, iniciar sesión será un poco diferente:
                    Introducirás tu contraseña, como de costumbre.</p>

                <p>A continuación, abra su aplicación Authenticator y copie el número de código en el formulario y envíelo.</p>
            @endif
        </x-slot>
        <x-slot name="right">

            <div class="card">

                @if (auth()->user()->two_fa_active == 'Yes' && auth()->user()->two_fa_secret_key !='')
                    <p>Su autenticación de 2 factores está en su lugar, para eliminar esto, haga clic en el botón a continuación.</p>
                    <x-button wire:click="remove">Desactivar 2FA</x-button>
                @else
                    <p>Las aplicaciones de autenticación generan códigos aleatorios que puede usar para iniciar sesión. No tienen acceso a su contraseña ni a la información de su cuenta.</p>
                    <p>Una contraseña es una buena aplicación de autenticación al igual que Authy.</p>

                    <p><img src='{{ $inlineUrl }}'></p>

                    <p>Escanee el código de barras en su aplicación de autenticación o ingrese manualmente esta clave {{ $secretKey }}</p>

                    <x-form.input wire:model="code" label='Código' name='code'></x-form.input>

                    <x-form wire:submit.prevent="update" method="put">

                    <x-button>Activar 2FA</x-button>

                @endif

                @include('errors.success')

                </x-form>
            </div>

        </x-slot>
    </x-2col>
</div>