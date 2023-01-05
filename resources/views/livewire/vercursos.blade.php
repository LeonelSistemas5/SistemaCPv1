<div class="p-5">
    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3">
        @if(count($this->cursos())>0)
        @foreach($this->cursos() as $item)
        <div class="max-w-md mx-auto mr-4 bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="p-8 ">
                    <div class="text-center mb-5"><i class="text-xl fa-solid fa-book-open"></i></div>
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Estado</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{$item->denominacion}}</a>
                    <p class="mt-2 text-slate-500">{{$item->temario}}</p>
                    <div class="mt-4 text-left">
                        <a href="" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ingregar
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
