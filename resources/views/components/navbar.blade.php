<nav class="font-dmsans absolute top-10 left-0 mb-10 flex items-center justify-between px-10 py-4 w-full">

    <!-- Left Menu -->
    <div class="flex items-center gap-6 text-black text-[16px]">
        {{ $slot }}
    </div>

    <!-- Search -->
    @isset($search)
    <div class="flex-grow flex justify-center">
        {{ $search }}
    </div>
    @endisset

    <div class="flex items-center gap-5 text-xl">
        {{ $right ?? '' }}
    </div>
</nav>
