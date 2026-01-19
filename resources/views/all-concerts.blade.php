<x-guest-layout>
    <div x-data="{ notifOpen: false }" class="overflow-x-hidden">

        <!-- NAVBAR -->
        <div class="w-full flex justify-center px-4">
             <div class="relative max-w-[1900px] w-full bg-secondary rounded-[40px] lg:rounded-[70px] shadow-lg p-6 lg:p-12">
                <x-navbar>
                    <!-- LEFT MENU -->
                    <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition"
                        href="{{ route('home') }}">Home</a>
                    <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition"
                        href="{{ route('home') }}#seating">Seating</a>

                    <div x-data="{ open: false }" class="relative hidden md:block">
                        <button @click="open = !open" class="flex items-center gap-1">
                            Category <img src="{{ asset('linedown.svg') }}" alt="">
                        </button>

                        <div x-show="open" @click.away="open=false"
                            class="absolute mt-2 bg-white shadow rounded-lg p-3 w-40 z-50">
                            @if(isset($navbarTypes))
                                @foreach($navbarTypes as $type)
                                    <a href="{{ route('category.index', ['type' => $type]) }}"
                                        class="block px-3 py-2 hover:bg-gray-100 rounded">{{ $type }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <x-slot:right>
                        <div class="flex items-center gap-4">

                            <!-- NOTIF -->
                            <button @click="window.dispatchEvent(new CustomEvent('notif-open'))">
                                <img src="{{ asset('notif.svg') }}" class="w-7 h-7">
                            </button>

                            <div x-data="{ open:false }" @notif-open.window="open=true" x-show="open"
                                class="fixed top-20 right-4 w-72 bg-white rounded-xl shadow-lg p-4 z-[999]">
                                <h2 class="font-semibold mb-3">Notifications</h2>
                                <div class="space-y-2 max-h-64 overflow-auto">
                                    <div class="bg-gray-100 p-2 rounded">New concert announced</div>
                                    <div class="bg-gray-100 p-2 rounded">Payment processing</div>
                                    <div class="bg-gray-100 p-2 rounded">Ticket confirmed</div>
                                </div>
                                <button @click="open=false" class="mt-3 w-full bg-secondary text-white py-2 rounded">
                                    Close
                                </button>
                            </div>

                            <!-- PROFILE -->
                            <div x-data="{ open:false }" class="relative">

                                @auth
                                    <button @click="open=!open" class="flex items-center gap-2">
                                        <img src="{{ asset('profile.svg') }}" class="w-8 h-8 rounded-full">
                                        <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                                    </button>

                                    <div x-show="open" @click.away="open=false"
                                        class="absolute right-0 mt-2 bg-white shadow rounded-lg w-40 p-2">
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.dashboardadmin') }}"
                                                class="block px-3 py-2 hover:bg-gray-100 rounded">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard') }}"
                                                class="block px-3 py-2 hover:bg-gray-100 rounded">
                                                Dashboard
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="flex items-center gap-2">
                                        <img src="{{ asset('profile.svg') }}" class="w-8 h-8 rounded-full">
                                        <span class="hidden sm:block">Login</span>
                                    </a>
                                @endguest

                            </div>

                    </x-slot:right>

                    <!-- SEARCH -->
                    <x-slot:search>
                        <form action="{{ route('category.index') }}" method="GET"
                            class="w-full md:w-1/2 bg-white rounded-full px-6 py-2 flex items-center gap-3 shadow">
                            <button type="submit">
                                <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70">
                            </button>
                            <input name="search"
                                class="w-full bg-transparent border-0 outline-none focus:outline-none focus:ring-0 focus:border-transparent"
                                placeholder="Search">
                        </form>
                    </x-slot:search>
                </x-navbar>

                <!-- HEADER TITLE -->
                <div class="text-center mt-24 mb-6">
                    <h1 class="text-4xl font-bold">All Concerts</h1>
                    <p class="mt-4 text-basetext">
                        Explore our complete collection of upcoming events.
                    </p>
                </div>
             </div>
        </div>

        <x-landing.concertcard :concerts="$concerts" />

        <x-footer />

    </div>
</x-guest-layout>
