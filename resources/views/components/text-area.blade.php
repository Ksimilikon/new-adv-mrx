@props(['disabled' => false])

<textarea @disabled($disabled)
    {{ $attributes->merge([
    'class' => 'px-4 py-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-y']) }}>{{$slot}}</textarea>
