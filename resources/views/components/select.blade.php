@props([
    'disabled' => false,
    'options' => [],
])

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-stone-300 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected($attributes->get('selected') == $value)>
            {{ $label }}
        </option>
    @endforeach
</select>
