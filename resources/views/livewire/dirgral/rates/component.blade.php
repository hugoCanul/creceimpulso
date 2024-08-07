<div>
    <div class="pb-4 font-medium text-gray-900 whitespace-nowrap dark:text-white justify-self-auto">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{$componentName}} | {{$pageTitle}}</h3>
    </div>
    <div class="flex items-center justify-between pb-4 bg-white ma-3 dark:bg-gray-900">
        <div class="justify-self-auto">
            @include('common.search')
        </div>
        <div class="justify-self-auto">
            <button wire:click="$set('open', true)" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800" type="button">
                <span class="block relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Crear nuevo
                </span>
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <x-table :headers="$headers" :rows="$rows" :displayColumns="$displayColumns"/>
    </div>
    @include('livewire.DirGral.rates.form')

    <x-confirm-delete></x-confirm-delete>
</div>
