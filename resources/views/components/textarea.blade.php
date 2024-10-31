@props(['label', 'name', 'value' => '', 'required' => false])

<div class="mb-4 h-full flex flex-col">
    <label for="{{ $name }}" class="block font-bold mb-2">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="5"
        class="border resize-none border-stone-700 p-2 w-full h-full rounded bg-stone-800" {{ $required ? 'required' : '' }}>{{ old($name, $value) }}</textarea>
</div>
