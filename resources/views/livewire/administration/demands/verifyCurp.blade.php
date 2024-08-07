<x-dialog-modal wire:model.live='demandsverifycurp.open'>
    <x-slot name="title">
        {{$componentName}} | Verificar CURP
    </x-slot>
    <x-slot name="content">
        <div>
                <form class="space-y-6" wire:submit.prevent='verify()'>
                    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-1">
                        <div>
                            <label for="curp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingresar CURP</label>
                            <input type="text" wire:model='demandsverifycurp.curp' id="curp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar CRUP">
                            @error('demandsverifycurp.curp')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</span></p>
                            @enderror
                        </div>
                    <div>
                </form>
                
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex items-center w-full p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button wire:click.prevent='verify()'  type="button"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>

            <button wire:click.prevent='resetUI()'  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
        </div>
    </x-slot>
</x-dialog-modal>