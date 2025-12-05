<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-logpage.container2>
            </x-logpage.container2>
        <x-logpage.container3>
            </x-logpage.container3>
        <x-logpage.container4>
            </x-logpage.container4>
                    <div class="absolute left-[60px] top-[200px] font-dmsans text-3xl font-bold text-[#4481DE]">
            <h1>
            Selamat Datang di
        </h1>
        <h1>
            UriSphynx Ticket
        </h1>
        </div>

        <div class="absolute left-[60px] top-[280px] font-dmsans text-3xl font-normal text-[#4481DE]">
            <h2>
            Masukkan Email dan
        </h2>
        <h2>
            Kata Sandi untuk Login
        </h2>
        </div>



        <x-logpage.container1>
            <!-- Email Address -->
             <h1 class="text-4xl font-semibold text-white flex justify-center p-4">LOGIN</h1>
        <div class="mt-10">
            <div class="relative top-[40px] left-[20px]">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.8" d="M2.49219 10.2266C4.18229 9.53906 5.80078 9.19531 7.34766 9.19531C8.89453 9.19531 10.4987 9.53906 12.1602 10.2266C13.8503 10.8854 14.6953 11.7591 14.6953 12.8477V14.6953H0V12.8477C0 11.7591 0.830729 10.8854 2.49219 10.2266ZM9.92578 6.27344C9.20964 6.98958 8.35026 7.34766 7.34766 7.34766C6.34505 7.34766 5.48568 6.98958 4.76953 6.27344C4.05339 5.55729 3.69531 4.69792 3.69531 3.69531C3.69531 2.69271 4.05339 1.83333 4.76953 1.11719C5.48568 0.372396 6.34505 0 7.34766 0C8.35026 0 9.20964 0.372396 9.92578 1.11719C10.6419 1.83333 11 2.69271 11 3.69531C11 4.69792 10.6419 5.55729 9.92578 6.27344Z" fill="#0E4375"/>
                </svg>
            </div>
            <x-text-input placeholder="Masukkan Email" id="email" class="block mt-1 w-full placeholder-[#0E4375]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-text-input id="password" class="block mt-1 w-full placeholder-[#0E4375]"
                            type="password" placeholder="Masukkan Password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </x-logpage.container1>

            <x-primary-button class="ms-3 flex justify-center mt-10 font-dmsans">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
