@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 shadow-[0_4px_23px_0_rgba(0,0,0,0.12)] focus:ring-indigo-500 rounded-[50px] px-4 py-4 shadow-sm font-dmsans']) !!}>
