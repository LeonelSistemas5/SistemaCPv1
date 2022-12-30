@props([
    'title' => '',
    'content' => '',
    'footer' => '',
    'height' => 'lg:w-full'
])

<div x-data="{ on: false }">
    {{ $trigger }}

    <div class="fixed overflow-auto z-50 inset-0 my-2 mx-auto w-full md:w-9/12 lg:w-1/2" x-show="on">

          <div
              class="fixed inset-0 transition-opacity"
              x-show="on"
              x-on:close-modal.window="on = false"
              x-on:keydown.escape.window="on = false"
              x-transition:enter="ease-out duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="ease-in duration-200"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0"
          >
              <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>

        <div class="bg-white dark:bg-gray-600 dark:text-gray-200 rounded-lg shadow-xl transform transition-all xs:w-full sm:w-full {{ $height }}" role="dialog" aria-modal="true" aria-labelledby="modal-headline"
           x-show="on"
           x-transition:enter="ease-out duration-300"
           x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
           x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave="ease-in duration-200"
           x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div class="flex flex-col p-4">

                <header class="flex flex-col text-center mb-2">
                    <h2>{{ $title }}</h2>
                </header>

                <main class="mb-4">
                    {{ $content }}
                </main>

                <footer class="flex justify-center space-x-2 border-t pt-2">
                    {{ $footer }}
                </footer>

            </div>
        </div>

    </div>

</div>
