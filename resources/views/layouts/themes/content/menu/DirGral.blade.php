
<li>
    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-direccion" data-collapse-toggle="dropdown-direccion">
        @include('layouts.themes.icons.DirGral')
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Dirección General</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    <ul id="dropdown-direccion" class="hidden py-2 space-y-2">
        <li>
            <a href="{{ route('indexcoordinator') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.role')
                <span class="flex-1 ml-3 whitespace-nowrap">Coordinadores</span>
            </a>
        </li>
        <li>
            <a href="{{ route('IndexAdministrador') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.administrator')
                <span class="flex-1 ml-3 whitespace-nowrap">Administradores</span>
            </a>
        </li>
        <li>
            <a href="{{ route('IndexRates') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.asingnTorole')
                <span class="flex-1 ml-3 whitespace-nowrap">Tazas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('IndexPromotor') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.promoter')
                <span class="flex-1 ml-3 whitespace-nowrap">Promotor</span>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('IndexUsers') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                @include('layouts.themes.icons.user')
                <span class="flex-1 ml-3 whitespace-nowrap">Usuarios</span>
            </a>
        </li>  --}}
    </ul>
</li>
