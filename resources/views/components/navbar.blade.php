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

    <!-- Right Menu -->
    <div class="flex items-center gap-5 text-xl">
        <span><img class="w-10 h-10" src="{{ asset('notif.svg') }}" alt=""></span>
        <span><img class="w-10 h-10" src="{{ asset('profile.svg') }}" alt=""></span>
        <a href="#" class="bg-[#303030] font-bold font-dmsans text-white px-6 py-3 rounded-[30px] text-[15px]">Login</a>
    </div>
</nav>
