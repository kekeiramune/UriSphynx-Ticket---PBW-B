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
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:text-[#707FDD]">
                    <img src="{{ asset('chart.svg') }}"><span>Dashboard</span>
                </a>

                <a href="{{ route('admin.transadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('cart.svg') }}"><span>Transaction History</span>
                </a>

                <a href="{{ route('admin.concertmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Ticket Management</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
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
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Category Management
                </h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#5A6ACF]">
                            <tr>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Group Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Type of Group
                                        </th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Debut Year</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Agency</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Popularity</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Action</th>
                                    </tr>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">
                                        {{ $category->groupname }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $category->type }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $category->debut }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $category->agency }}
                                    </td>

                                    <td class="px-4 py-2 text-center font-semibold">
                                        {{ $category->popular }}
                                    </td>

                                    <td class="px-4 py-2 flex flex-row gap-4">
                                        <a
                                            href="{{ route('admin.category.edit', $category->idgroup) }}"><img src="{{ asset('pencilwrite.svg') }}" alt=""></a>

                                        <form action="{{ route('admin.category.delete', $category->idgroup) }}"
                                            method="POST">
                                            @csrf
                                            <button onclick="confirmDelete(event)"
                                                type="submit"><img src="{{ asset('binred.svg') }}" alt=""></button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">
                                        No category data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <a href="{{ route('admin.category.create') }}"
                        class="px-4 py-2 bg-[#5A6ACF] text-white rounded-lg hover:bg-[#4b5ac0] transition">
                        + Add Category
                    </a>
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

        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>