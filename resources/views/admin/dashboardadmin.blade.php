<x-app-layout>
    <div class="min-h-screen flex bg-secondary">
    <!-- Sidebar -->
    <aside class="w-64 bg-white text-[#273240] flex flex-col">
        <!-- Logo / Title -->
        <div class="h-16 flex items-center px-6 text-xl font-semibold border-b border-slate-700">
            UriSphynx Admin
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Menu</p>
            <a href="{{ route('admin.dashboardadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:text-[#707FDD] transition">
                <img src="{{ asset('chart.svg') }}" alt=""><span>Dashboard</span>
            </a>

            <a href="{{ route('admin.transadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:text-[#707FDD] transition">
                <img src="{{ asset('cart.svg') }}" alt=""><span>Transaction History</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
               <img src="{{ asset('doc.svg') }}" alt=""><span>Concert Management</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
               <img src="{{ asset('doc.svg') }}" alt=""><span>Ticket Management</span>
            </a>
            <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Others</p>
            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
               <img src="{{ asset('profadmin.svg') }}" alt=""><span>Accounts</span>
            </a>
            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
               <img src="{{ asset('logout.svg') }}" alt=""><span>Logout</span>
            </a>
        </nav>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>
</x-app-layout>