<x-dialog-modal wire:model='open'>
    <x-slot name="title">
        {{$componentName}} | {{$selected_id > 0 ? 'EDITAR':' NUEVO'}}
    </x-slot>
    <x-slot name="content">
        <div>
            @if ($selected_id > 0)
                <form class="space-y-6" wire:submit.prevent='Update()'>
            @else
                <form class="space-y-6" wire:submit.prevent='Store()'>
            @endif
                <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Taza</label>
                        <input type="text" wire:model='name' id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nueva Taza">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div>
                        <label for="cicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciclo</label>
                        <input type="text" wire:model='cicle' id="cicle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ciclo">
                        @error('cicle')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div>
                        <label for="minamount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mínimo</label>
                        <input type="text" wire:model='minamount' id="minamount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mínimo">
                        @error('minamount')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div>
                        <label for="maxamount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Máximo</label>
                        <input type="text" wire:model='maxamount' id="maxamount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Máximo">
                        @error('maxamount')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div>
                        <label for="rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Taza</label>
                        <input type="text" wire:model='rate' id="rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Taza">
                        @error('rate')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                    <div>
                        <x-select-model 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            :options="$cities"
                            wire:model="cities_id" 
                            value-field="id" 
                            label-field="name" 
                            label="Sucursales"
                            >
                        </x-select-model>
                        @error('rate')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                <div>
            </form>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex items-center w-full p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            @if ($selected_id > 0)
                <button wire:click.prevent='Update()'  type="button"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</button>
            @else
                <button wire:click.prevent='Store()'  type="button"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
            @endif
            <button wire:click.prevent='resetUI()'  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
        </div>
    </x-slot>
</x-dialog-modal>