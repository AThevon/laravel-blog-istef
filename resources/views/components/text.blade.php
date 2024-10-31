@props(['label', 'name', 'value' => '', 'required' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block font-bold mb-2">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" 
           class="border border-stone-700 bg-stone-800 p-2 w-full rounded"
           value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }}>
</div>