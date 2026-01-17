<x-guest-layout>
<div x-data="{ notifOpen: false, filterOpen: false }">

    <div class="w-full flex justify-center">
        <div class="max-w-[1900px] w-full h-[650px] p-10 rounded-[70px] bg-secondary shadow-lg relative">

            <x-navbar>
                <!-- LEFT MENU -->
                <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold"
                   href="{{ route('home') }}">Home</a>

                <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold"
                   href="{{ route('home') }}#seating">Seating</a>

                <!-- CATEGORY DROPDOWN -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-1">
                        Category <span><img src="{{ asset('linedown.svg') }}" alt=""></span>
                    </button>

                    <div x-show="open" x-transition @click.away="open = false"
                         class="absolute bg-white shadow-lg rounded-lg mt-2 p-3 w-40 z-50 origin-top">
                        @if(isset($navbarTypes))
                            @foreach($navbarTypes as $type)
                                <a href="{{ route('category.index', ['type' => $type]) }}" 
                                   class="block px-3 py-2 hover:bg-gray-100 rounded">{{ $type }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- RIGHT SLOT -->
                <x-slot:right>
                    <div class="flex justify-end gap-5 text-xl">

                        <!-- NOTIF BUTTON -->
                        <button @click="notifOpen = true">
                            <img class="w-8 h-8 relative" src="{{ asset('notif.svg') }}" alt="">
                        </button>

                        <!-- NOTIF DROPDOWN -->
                        <div x-show="notifOpen" x-transition
                             class="fixed top-20 right-10 w-80 bg-white shadow-xl rounded-2xl p-5 z-[999] border"
                             @click.away="notifOpen = false">
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

                            <button class="mt-4 w-full bg-secondary text-white py-2 rounded-lg"
                                    @click="notifOpen = false">
                                Close
                            </button>
                        </div>

                        <!-- PROFILE DROPDOWN -->
                        <div x-data="{ openProfile: false }" class="relative ml-auto">
                            <button @click="openProfile = !openProfile" class="flex items-center gap-2">
                                <img src="{{ asset('profile.svg') }}" class="w-9 h-9 rounded-full object-cover" />
                                <span>
                                    @if(Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif
                                </span>
                            </button>

                            <div x-show="openProfile" x-transition @click.away="openProfile = false"
                                 class="absolute right-0 bg-white shadow-lg rounded-lg mt-2 p-3 w-44 z-50 origin-top">
                                <a href="{{ route('dashboard') }}" class="block px-3 py-2 hover:bg-gray-100 rounded">
                                    Dashboard
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="block w-full text-left px-3 py-2 hover:bg-gray-100 rounded">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </x-slot:right>

                <!-- SEARCH BAR -->
                <x-slot:search>
                    <form action="{{ route('category.index') }}" method="GET" class="w-1/2 bg-white rounded-full px-8 py-1 flex items-center gap-3 shadow">
                        <button type="submit">
                            <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70">
                        </button>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                               class="w-full bg-transparent border-none focus:outline-none outline-none focus:ring-0 focus:border-none font-dmsans text-blacktext" />
                    </form>
                </x-slot:search>

            </x-navbar>

            <!-- HERO SECTION IMAGE + TEXT -->
            <img class="absolute rounded-[29.273px] w-[592px] h-[380px] top-[150px] mt-[50px] left-10"
                 src="{{ asset('h2h.jpeg') }}" alt="">

            <div class="absolute right-10 top-[210px] mt-[60px] text-basetext font-bold text-[48px] leading-[56px] flex flex-col gap-6">
                <h1>Transaksi aman,</h1>
                <span>nonton konser nyaman</span>
            </div>

            <div class="absolute left-[700px] top-[380px] mt-[60px] w-[550px] text-basetext text-[18px] leading-[28px]">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit…</p>
            </div>

            <!-- BUTTONS -->
            <div class="absolute bottom-10 right-[200px] flex gap-4">
                <button class="bg-white hover:bg-customHover text-blacktext font-semibold py-3 px-6 rounded-[36.55px] shadow-md">
                    Get Started
                </button>

                <button class="bg-customButton hover:bg-customHover text-white font-semibold py-3 px-6 rounded-[36.55px] flex items-center gap-2 shadow-md">
                    <a href="{{ route('login') }}">Sign in Now</a>
                    <img src="{{ asset('arrow1.svg') }}" class="w-[13.5px] h-[12.691px]">
                </button>
            </div>

        </div>
    </div>

    <!-- CATEGORY SECTION -->
    <div class="text-center mt-20 text-4xl font-bold text-blacktext">
        <h1>Categories</h1>
    </div>

    <div class="flex justify-center gap-5 mt-10 mb-5">
        <form action="{{ route('category.index') }}" method="GET" class="w-[1000px] bg-white rounded-full px-8 py-1 flex items-center gap-3 shadow">
            <button type="submit">
                <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70">
            </button>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for groups"
                   class="w-full bg-transparent outline-none focus:outline-none focus:ring-0 focus:border-none border-none font-dmsans text-blacktext">
            
            <!-- Preserve other filters when searching -->
            @if(request('type')) <input type="hidden" name="type" value="{{ request('type') }}"> @endif
        </form>

        <button @click="filterOpen = !filterOpen">
            <img class="w-10 h-10" src="{{ asset('filter.svg') }}">
        </button>

        <div x-show="filterOpen" x-transition
             class="fixed top-20 right-10 w-80 bg-white shadow-xl rounded-2xl p-5 z-[999] border max-h-[80vh] overflow-y-auto"
             @click.away="filterOpen = false" style="display: none;">
            
            <form action="{{ route('category.index') }}" method="GET">
                <!-- Preserve Search and Type -->
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                @if(request('type')) <input type="hidden" name="type" value="{{ request('type') }}"> @endif

                <h2 class="mt-5 font-semibold text-lg mb-3">Debut Year</h2>
                <div class="space-y-3 max-h-72 overflow-auto">
                    @foreach([
                        'pre_2010' => '1st Gen / pre-2010',
                        '2010_2015' => '2010-2015',
                        '2016_2020' => '2016-2020',
                        '2021_plus' => '2021+'
                    ] as $val => $label)
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span>{{ $label }}</span>
                            <input type="checkbox" name="debut_year[]" value="{{ $val }}" 
                                   class="hidden peer" 
                                   {{ in_array($val, (array)request('debut_year')) ? 'checked' : '' }}>
                            <div class="w-6 h-6 border-2 border-gray-300 rounded-md peer-checked:bg-secondary peer-checked:border-secondary flex items-center justify-center">
                                <img src="{{ asset('check.svg') }}" class="w-4 h-4 opacity-0 peer-checked:opacity-100 invert">
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>

                <h2 class="mt-5 font-semibold text-lg mb-3">Agency</h2>
                <div class="space-y-3 max-h-72 overflow-auto">
                    @foreach(['JYP', 'SM', 'YG', 'HYBE', 'Cube'] as $agency)
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span>{{ $agency }}</span>
                            <input type="checkbox" name="agency[]" value="{{ $agency }}" 
                                   class="hidden peer"
                                   {{ in_array($agency, (array)request('agency')) ? 'checked' : '' }}>
                             <div class="w-6 h-6 border-2 border-gray-300 rounded-md peer-checked:bg-secondary peer-checked:border-secondary flex items-center justify-center">
                                <img src="{{ asset('check.svg') }}" class="w-4 h-4 opacity-0 peer-checked:opacity-100 invert">
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>

                <h2 class="mt-5 font-semibold text-lg mb-3">Sort By</h2>
                <div class="space-y-3 max-h-72 overflow-auto">
                    @foreach([
                        'popular' => 'Most Popular',
                        'trending' => 'Trending',
                        'newest' => 'Newly Added'
                    ] as $val => $label)
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span>{{ $label }}</span>
                            <input type="radio" name="sort" value="{{ $val }}" 
                                   class="hidden peer"
                                   {{ request('sort') == $val ? 'checked' : '' }}>
                             <div class="w-6 h-6 rounded-full border-2 border-gray-300 peer-checked:bg-secondary peer-checked:border-secondary"></div>
                        </label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="mt-4 w-full bg-secondary text-white py-2 rounded-[36px] mb-2 hover:bg-customHover">
                    Apply
                </button>

                <a href="{{ route('category.index') }}" class="block text-center mt-2 w-full bg-gray-200 text-gray-700 py-2 rounded-[36px] hover:bg-gray-300">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <!-- CATEGORY BUTTONS -->
    <div class="flex justify-center flex-wrap gap-4 md:gap-10 mb-10">
        <!-- 'All' Button -->
        <a href="{{ route('category.index', array_merge(request()->except('type'))) }}" 
           class="relative transition-all duration-200 py-2 px-4 rounded-full shadow-md font-semibold
           {{ !request('type') ? 'bg-secondary text-white' : 'bg-white hover:bg-customHover hover:text-white text-blacktext' }}">
            All
        </a>

        @foreach (['Girlgroup','Boygroup','Co-ed group','Band','Soloist'] as $cat)
            <a href="{{ route('category.index', array_merge(request()->query(), ['type' => $cat])) }}" 
               class="relative transition-all duration-200 py-2 px-4 rounded-full shadow-md font-semibold
               {{ request('type') == $cat ? 'bg-secondary text-white' : 'bg-white hover:bg-customHover hover:text-white text-blacktext' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <!-- CATEGORY CARDS -->
    <x-category.container1c :category="$category"/>

    <!-- FOOTER -->
    <x-footer>
        <div class="flex flex-col absolute right-[100px] md:flex-row items-center justify-center gap-12 p-12">
            <a href="{{ route('home') }}">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#"><img class="w-8 h-8" src="{{ asset('fb.svg') }}"></a>
            <a href="#"><img class="w-8 h-8" src="{{ asset('insta.svg') }}"></a>
            <a href="#"><img class="w-8 h-8" src="{{ asset('twit.svg') }}"></a>
        </div>
    </x-footer>

</div>

<script>
    const icon = document.getElementById('icon');
document.addEventListener('alpine:init', () => {
    @if(session('notif') === 'open')
        setTimeout(() => { window.dispatchEvent(new CustomEvent('notif-open')); }, 10);
    @endif

    @if(session('filter') === 'open')
        setTimeout(() => { window.dispatchEvent(new CustomEvent('filter-open')); }, 10);
    @endif
});

document.addEventListener('DOMContentLoaded', () => {
        const icons = document.querySelectorAll('.check-icon');

        icons.forEach(icon => {
            icon.addEventListener('click', () => {
                if (icon.src.includes('uncheck.svg')) {
                    icon.src = "{{ asset('check.svg') }}";
                } else {
                    icon.src = "{{ asset('uncheck.svg') }}";
                }
            });
        });
    });
</script>

</x-guest-layout>