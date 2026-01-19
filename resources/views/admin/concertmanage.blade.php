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
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:text-[#707FDD] transition">
                    <img src="{{ asset('chart.svg') }}"><span>Dashboard</span>
                </a>

                <a href="{{ route('admin.transadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('cart.svg') }}"><span>Transaction History</span>
                </a>

                <a href="{{ route('admin.concertmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('docblack.svg') }}"><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Ticket Management</span>
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
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded-lg p-6">
                <!-- Header with Add Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-[#273240]">
                        Concert Management
                    </h1>
                    <a href="{{ route('admin.concert.create') }}"
                        class="px-6 py-3 bg-[#707FDD] text-white rounded-lg hover:bg-[#5f6bc9] transition flex items-center gap-2 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Concert
                    </a>
                </div>

                <!-- Success/Error Messages -->




                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#707FDD]">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Image</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Concert Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Date & Time</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Venue & City</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Category</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Status</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-white">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($concerts as $concert)
                                <tr class="hover:bg-gray-50 transition border-b border-gray-200">
                                    <td class="px-4 py-3">
                                        @if($concert->image)
                                            <img src="{{ asset('storage/' . $concert->image) }}" 
                                                alt="{{ $concert->concert_name }}"
                                                class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 font-medium text-[#273240]">
                                        {{ $concert->concert_name }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        <div>{{ \Carbon\Carbon::parse($concert->concert_date)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($concert->concert_time)->format('H:i') }}</div>
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        <div>{{ $concert->venue }}</div>
                                        <div class="text-sm text-gray-500">{{ $concert->city }}</div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">
                                            {{ $concert->category_name ?? 'No Category' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        @if($concert->status_concert == 'Upcoming')
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">Upcoming</span>
                                        @elseif($concert->status_concert == 'Ongoing')
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Ongoing</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">Completed</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('admin.concert.edit', $concert->id_concert) }}"
                                                class="text-blue-600 hover:text-blue-800 transition"
                                                title="Edit">
                                                <img src="{{ asset('pencilwrite.svg') }}" alt="Edit" class="w-5 h-5">
                                            </a>

                                            <form action="{{ route('admin.concert.delete', $concert->id_concert) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="button" onclick="confirmDelete(event, this.closest('form'))"
                                                    class="text-red-600 hover:text-red-800 transition"
                                                    title="Delete">
                                                    <img src="{{ asset('binred.svg') }}" alt="Delete" class="w-5 h-5">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-500">
                                        No concerts available
                                    </td>
                                </tr>
                            @endforelse
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

        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Concert?',
                text: 'This action cannot be undone. Concerts with tickets cannot be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>