<nav x-data="{ mobileNav: false, mobileSearch: false }"
    class="font-dmsans w-full z-50 px-4 md:px-10 py-4 transition-all duration-300"
    :class="mobileNav || mobileSearch ? 'relative bg-white shadow-lg rounded-b-[30px]' : 'absolute top-0 left-0'">

    <div class="flex items-center justify-between gap-2 md:gap-4 relative z-50">

        <!-- Left: Hamburger + Menu -->
        <div class="flex items-center gap-4">
            <!-- Mobile Toggle -->
            <button @click="mobileNav = !mobileNav"
                class="md:!hidden p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                    :class="mobileNav || mobileSearch ? 'text-black' : 'text-black md:text-white'" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Menu (Slot) -->
            <div class="hidden md:!flex items-center gap-6 text-[16px]">
                {{ $slot }}
            </div>
        </div>

        <!-- Center: Search (Desktop) -->
        @isset($search)
            <div class="hidden md:!flex flex-grow justify-center max-w-2xl px-4">
                {{ $search }}
            </div>
        @endisset

        <!-- Right: Actions -->
        <div class="flex items-center gap-2 md:gap-5">
            <!-- Mobile Search Toggle -->
            @isset($search)
                <button @click="mobileSearch = !mobileSearch; mobileNav = false"
                    class="md:!hidden p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-70"
                        :class="mobileNav || mobileSearch ? 'text-black' : 'text-black md:text-white'" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            @endisset

            <div class="flex items-center gap-3 md:gap-5 text-xl">
                {{ $right ?? '' }}
            </div>
        </div>
    </div>

    <!-- Mobile Search Expanded -->
    @isset($search)
        <div x-show="mobileSearch" x-transition
            class="md:!hidden absolute top-full left-0 w-full bg-white shadow-lg p-4 rounded-b-[30px] z-40">
            {{ $search }}
        </div>
    @endisset

    <!-- Mobile Menu Expanded -->
    <div x-show="mobileNav" x-transition
        class="md:!hidden absolute top-full left-0 w-full bg-white shadow-lg p-6 flex flex-col gap-6 rounded-b-[30px] z-40 border-t border-gray-100">
        <div class="flex flex-col gap-4 text-lg font-medium text-gray-800">
            {{ $slot }}
        </div>
    </div>
</nav>