<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-navbar>
    <!-- LEFT MENU -->
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="#">Home</a>
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="#">Seating</a>
    <div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center gap-1">
        Category <span><img src="{{ asset('linedown.svg') }}" alt=""></span>
    </button>

    <div
        x-show="open"
        x-transition
        @click.away="open = false"
        class="absolute bg-white shadow-lg rounded-lg mt-2 p-3 w-40 z-50 origin-top"
    >
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Boygroup</a>
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Girlgroup</a>
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Co-ed group</a>
    </div>
</div>


    <!-- SEARCH BAR -->
    <x-slot:search>
    <div class="w-1/2 bg-white rounded-full px-8 py-1 flex items-center gap-3 shadow">
        <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70" alt="">
        <input
        type="text"
        placeholder="Search"
        class="w-full bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-none font-dmsans text-blacktext"
    />
</div>
</x-slot:search>
</x-navbar>
<div class="relative gap-4">
    <h1 class="absolute top-[230px] font-semibold text-3xl left-[90px]">Welcome back, </h1>
    <h1 class="absolute top-[270px] font-semibold text-3xl left-[90px]">{{ Auth::user()->name }}!</h1>
</div>

<x-dashboard.container1d>
</x-dashboard.container1d>

<h1 class="relative top-[400px] right-[400px] font-bold text-3xl text-center">Active Tickets Available</h1>
<x-dashboard.container2d></x-dashboard.container2d>
</x-app-layout>
