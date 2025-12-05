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
             <h1 class="text-4xl font-semibold text-white flex justify-center p-6">LOGIN</h1>
        <div class="mt-4 relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.49219 10.2266C4.18229 9.53906 5.80078 9.19531 7.34766 9.19531C8.89453 9.19531 10.4987 9.53906 12.1602 10.2266C13.8503 10.8854 14.6953 11.7591 14.6953 12.8477V14.6953H0V12.8477C0 11.7591 0.830729 10.8854 2.49219 10.2266ZM9.92578 6.27344C9.20964 6.98958 8.35026 7.34766 7.34766 7.34766C6.34505 7.34766 5.48568 6.98958 4.76953 6.27344C4.05339 5.55729 3.69531 4.69792 3.69531 3.69531C3.69531 2.69271 4.05339 1.83333 4.76953 1.11719C5.48568 0.372396 6.34505 0 7.34766 0C8.35026 0 9.20964 0.372396 9.92578 1.11719C10.6419 1.83333 11 2.69271 11 3.69531C11 4.69792 10.6419 5.55729 9.92578 6.27344Z" fill="#0E4375"/>
                </svg>
            </div>
            <x-text-input placeholder="Masukkan Email" id="email" class="block mt-1 w-full placeholder-[#0E4375] pl-12" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative mt-4">
            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                <svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.21094 6.78906C4.58333 7.16146 5.01302 7.34766 5.5 7.34766C5.98698 7.34766 6.41667 7.16146 6.78906 6.78906C7.16146 6.41667 7.34766 5.98698 7.34766 5.5C7.34766 5.01302 7.16146 4.58333 6.78906 4.21094C6.41667 3.83854 5.98698 3.65234 5.5 3.65234C5.01302 3.65234 4.58333 3.83854 4.21094 4.21094C3.86719 4.58333 3.69531 5.01302 3.69531 5.5C3.69531 5.98698 3.86719 6.41667 4.21094 6.78906ZM10.6992 3.65234H20.1953V7.34766H18.3477V11H14.6953V7.34766H10.6992C10.3268 8.35026 9.625 9.20964 8.59375 9.92578C7.59115 10.6419 6.5599 11 5.5 11C3.98177 11 2.67839 10.4701 1.58984 9.41016C0.529948 8.32161 0 7.01823 0 5.5C0 3.98177 0.529948 2.69271 1.58984 1.63281C2.67839 0.544271 3.98177 0 5.5 0C6.5599 0 7.59115 0.358073 8.59375 1.07422C9.625 1.79036 10.3268 2.64974 10.6992 3.65234Z" fill="#0E4375"/>
            </svg>
            </div>

            <x-text-input id="password" class="block mt-1 w-full placeholder-[#0E4375] pl-12"
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

            <div class="flex justify-center mt-4 font-dmsans text-sm text-white">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Disini</a></p>
            </div>
        </div>
    </form>
</x-guest-layout>
