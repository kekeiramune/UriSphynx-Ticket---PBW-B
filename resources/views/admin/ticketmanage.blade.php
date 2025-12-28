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
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Ticket Management</span>
                </a>
                <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Others</p>
                <a href="{{ route('admin.accountmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('profadmin.svg') }}" alt=""><span>Accounts</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('logout.svg') }}" alt=""><span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Ticket Management
                </h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#5A6ACF]">
                            <tr>
                                <thead class="bg-[#5A6ACF]">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Concert</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Date</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Venue</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Category</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Quota</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Price</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-white">Action</th>
                                    </tr>
                                </thead>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($concerts as $concert)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">
                                        {{ $concert->concert_name }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $concert->concert_date }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $concert->venue }}
                                    </td>

                                    <td class="px-4 py-2">
                                        {{ $concert->name_seating }}
                                    </td>

                                    <td class="px-4 py-2 text-center font-semibold">
                                        {{ $concert->quota }}
                                    </td>

                                    <td class="px-4 py-2">
                                        Rp {{ number_format($concert->ticket_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('admin.ticket.edit', $concert->id_price) }}"
                                            class="px-3 py-1 text-sm bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">
                                            Edit
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-500">
                                        No ticket data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </main>

    </div>
</x-app-layout>