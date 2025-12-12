<x-app-layout>
    <div x-data="{ notif: false }">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-navbar>
    <!-- LEFT MENU -->
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="{{ route('home') }}">Home</a>
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

<x-slot:right>

<div class="flex justify-end gap-5 text-xl">
    <div class="flex justify-end gap-5 text-xl">
    <button 
    @click="notif = !notif"
    >
    <img class="w-8 h-8 relative" src="{{ asset('notif.svg') }}" alt="">
</button>

<!-- NOTIFICATION DROPDOWN -->
<div 
    x-show="notif"
    class="fixed top-20 right-10 w-80 bg-white shadow-xl rounded-2xl p-5 z-[999] border"
>
    <h2 class="font-semibold text-lg mb-3">Notifications</h2>

    <div class="space-y-3 max-h-72 overflow-auto">
        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your favorite group just announced a new concert!</p>
        </div>

        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your payment is being processed…</p>
        </div>

        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your ticket is confirmed!</p>
        </div>
    </div>

    <button
     
        class="mt-4 w-full bg-secondary text-white py-2 rounded-lg"
        @click="notif = false"
    >
        Close
    </button>
</div>
    <!-- PROFILE DROPDOWN -->
<div x-data="{ openProfile: false }" class="relative ml-auto">
    <button @click="openProfile = !openProfile" class="flex items-center gap-2">
        <img
            src="{{ asset('profile.svg') }}"
            alt=""
            class="w-9 h-9 rounded-full object-cover top-full"
        />
        @if(Auth::check())
        <span>{{ Auth::user()->name }}</span>
        @endif
    </button>

    <div
        x-show="openProfile"
        x-transition
        @click.away="openProfile = false"
        class="absolute right-0 bg-white shadow-lg rounded-lg mt-2 p-3 w-44 z-50 origin-top"
    >
        <a href="#" class=""></a>
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-3 py-2 hover:bg-gray-100 rounded">
                Logout
            </button>
        </form>
    </div>
</div>
</div>
</x-slot:right>


</x-navbar>
<div class="relative gap-4">
    <h1 class="absolute top-[230px] font-semibold text-3xl left-[90px]">Welcome back, </h1>
    <h1 class="absolute top-[270px] font-semibold text-3xl left-[90px]">
        @if(Auth::check())
        {{ Auth::user()->name }}!
        @endif
    </h1>
</div>

<x-dashboard.container1d>
</x-dashboard.container1d>

<h1 class="relative left-[80px] mt-10 font-bold text-3xl text-start">Active Tickets Available</h1>
<x-dashboard.container2d></x-dashboard.container2d>

<h1 class="relative mt-10 left-[80px] font-bold text-3xl text-start">Purchase History</h1>
<x-dashboard.purtable></x-dashboard.purtable>
</div>

<x-footer>
        <div class="flex flex-col absolute right-[100px] md:flex-row items-center justify-center gap-12 p-12">
            <a href="{{ route('home') }}">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('fb.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('insta.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('twit.svg') }}" alt=""></a>
        </div>
    </x-footer>
</x-app-layout>
