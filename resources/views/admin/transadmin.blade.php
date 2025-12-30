<x-app-layout>
    <div class="min-h-screen flex bg-secondary">
<<<<<<< HEAD

        <!-- Sidebar -->
        <aside class="w-64 bg-white text-[#273240] flex flex-col">
            <div class="h-16 flex items-center px-6 text-xl font-semibold border-b">
                UriSphynx Admin
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <p class="px-4 text-gray-500 uppercase text-sm">Menu</p>

                <a href="{{ route('admin.dashboardadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:text-[#707FDD]">
                    <img src="{{ asset('chart.svg') }}"><span>Dashboard</span>
                </a>

                <a href="{{ route('admin.transadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('cart.svg') }}"><span>Transaction History</span>
                </a>

                <a href="{{ route('admin.concertmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}" alt=""><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}" alt=""><span>Ticket Management</span>
                </a>
                <a href="{{ route('admin.categorymanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}" alt=""><span>Category Management</span>
                </a>
                <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Others</p>
                <a href="{{ route('admin.accountmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('profadmin.svg') }}" alt=""><span>Accounts</span>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="javascript:void(0)" onclick="confirmLogout()"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                        <img src="{{ asset('logout.svg') }}" alt="">
                        <span>Logout</span>
                    </a>
                </form>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Transaction History
                </h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#5A6ACF]">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Username</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">POP</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">Yuuki</td>
                                <td class="px-4 py-3">
                                    <span class="bg-green-500 text-white px-3 py-1 rounded text-xs">Success</span>
                                </td>
                                <td class="px-4 py-3 text-sm">QRIS</td>
                                <td class="px-4 py-3 text-sm text-blue-500 underline cursor-pointer">
                                    View
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">Admin</td>
                                <td class="px-4 py-3">
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">Pending</span>
                                </td>
                                <td class="px-4 py-3 text-sm">Dana</td>
                                <td class="px-4 py-3 text-sm text-blue-500 underline cursor-pointer">
                                    View
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
=======
    <!-- Sidebar -->
    <aside class="w-64 bg-gray text-white flex flex-col">
        <!-- Logo / Title -->
        <div class="h-16 flex items-center px-6 text-xl font-semibold border-b border-slate-700">
            UriSphynx Admin
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboardadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 transition">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.transadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 transition">
                <span>Transactions</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 tra

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C]">Transaction History</h1>
                <table class="mt-5 min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-[#5A6ACF]">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Username</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Payment Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Payment Method</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">POP (Proof of Payment)</th>
                        </tr>
                    </thead>

                     <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800">Yuuki</td>
                            <td class="px-4 py-3 text-sm text-gray-600"><button class="bg-green-500 text-white px-2 py-1 rounded">Success</button></td>
                            <td class="px-4 py-3 text-sm text-gray-600">Qris</td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800">Admin</td>
                            <td class="px-4 py-3 text-sm text-gray-600"><button class="bg-yellow-500 text-white px-2 py-1 rounded">Pending</button></td>
                            <td class="px-4 py-3 text-sm text-gray-600">Dana</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
</x-app-layout>