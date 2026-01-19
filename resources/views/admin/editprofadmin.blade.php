@php
    $user = Auth::user();
@endphp
<x-app-layout>
    <div class="min-h-screen flex bg-secondary">

        <!-- Sidebar -->
        <aside class="w-64 bg-white text-[#273240] flex flex-col">
            <div class="h-16 flex items-center px-6 text-xl font-semibold border-b">
                UriSphynx Admin
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <p class="px-4 text-gray-500 uppercase text-sm">Menu</p>

                <a href="{{ route('admin.dashboardadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('chart.svg') }}"><span>Dashboard</span>
                </a>

                <a href="{{ route('admin.transadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('cart.svg') }}"><span>Transaction History</span>
                </a>

                <a href="{{ route('admin.concertmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}"><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}"><span>Ticket Management</span>
                </a>

                <a href="{{ route('admin.categorymanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}"><span>Category Management</span>
                </a>

                <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Others</p>

                <a href="{{ route('admin.accountmanage') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('profadmin.svg') }}"><span>Accounts</span>
                </a>

                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="javascript:void(0)" onclick="confirmLogout()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                        <img src="{{ asset('logout.svg') }}">
                        <span>Logout</span>
                    </a>
                </form>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6">
            <h1 class="text-xl font-semibold text-[#1F384C] mb-4">Edit Profile</h1>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center gap-4 mb-6">
    <img 
        src="{{ $user->accimage 
                ? asset('storage/photo_profile/' . $user->accimage) 
                : asset('calebb.jpg') }}"
        class="w-[200px] h-[200px] rounded-full object-cover"
    />

    <label
        for="profile_photo"
        class="cursor-pointer bg-white text-[#5A6ACF] font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition"
    >
        Change Photo
    </label>

    <input 
        type="file" 
        id="profile_photo" 
        name="accimage" 
        class="hidden"
        accept="image/*"
    />
</div>

                <div class="mt-2 mb-2">
                    <label class="font-semibold">Name</label>
                    <input
                        type="text"
                        name="adminname"
                        value="{{ old('adminname', auth()->user()->name) }}"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="mt-2 mb-2">
                    <label class="font-semibold">Email</label>
                    <input
                        type="email"
                        name="adminemail"
                        value="{{ old('adminemail', auth()->user()->email) }}"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="mt-2 mb-2">
                    <label class="font-semibold">Phone Number</label>
                    <input
                        type="text"
                        name="adminumber"
                        value="{{ old('adminumber', auth()->user()->no_hp) }}"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="flex p-4 gap-3">
                    <button
                        type="submit"
                        class="bg-white text-[#5A6ACF] font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        Save Changes
                    </button>

                    <a href="{{ route('admin.accountmanage') }}"
                        class="bg-white text-[#5A6ACF] font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </main>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: 'You will be signed out from your account',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }

    </script>
</x-app-layout>
