<div>
    <label for="select" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select id="select" name="select" {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
        <option value="">Seleccione una opción</option>
        @forelse($options as $option)
            <option value="{{ $option[$valueField] }}" @if($option[$valueField] == $selected) selected @endif>{{ $option[$labelField] }}</option>
        @empty
            <option value="" disabled>No hay opciones disponibles</option>
        @endforelse
    </select>
</div>