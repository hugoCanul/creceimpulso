@props(['headers', 'rows', 'displayColumns'])

<div class="overflow-x-auto">
    <table class="min-w-full bg-white dark:bg-gray-800">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200 dark:bg-gray-700 dark:text-gray-300">
                        {{ $header }}
                    </th>
                @endforeach
                <th class="px-4 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200 dark:bg-gray-700 dark:text-gray-300">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($displayColumns as $column)
                        <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            @php
                                $value = $row;
                                foreach (explode('.', $column) as $segment) {
                                    if (isset($value->$segment)) {
                                        $value = $value->$segment;
                                    } else {
                                        $value = null;
                                        break;
                                    }
                                }
                            @endphp
                            {{ $value }}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="Editar({{ $row->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            @include('layouts.themes.icons.editar')
                        </button>
                        <button @click="$dispatch('confirm-delete', { id: {{ $row->id }} })" type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            @include('layouts.themes.icons.delete')
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) + 1 }}" class="px-4 py-2 text-center text-gray-500">
                        No records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 mb-4 ml-2 mr-2">
        {{ $rows->links() }}
    </div>
</div>