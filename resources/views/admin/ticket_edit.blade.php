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
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
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
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-[#273240]">Edit Ticket</h1>
                    <p class="text-gray-500 mt-1">Update ticket information for {{ $ticket->concert_name }} ({{ $ticket->name_seating }})</p>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <form method="POST" action="{{ route('admin.ticket.update', $ticket->id_price) }}">
                        @csrf

                        <!-- Concert Info Display -->
                        <div class="bg-gradient-to-r from-[#707FDD] to-[#5f6bc9] rounded-lg p-6 mb-8 text-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm opacity-90">Concert</p>
                                    <p class="text-xl font-bold">{{ $ticket->concert_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm opacity-90">Seating Category</p>
                                    <p class="text-xl font-bold">{{ $ticket->name_seating }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ticket Price -->
                            <div>
                                <label for="ticket_price" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Ticket Price (IDR) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="ticket_price" id="ticket_price" 
                                    value="{{ old('ticket_price', $ticket->ticket_price) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                    placeholder="e.g., 500000" required min="0">
                            </div>

                            <!-- Quota -->
                            <div>
                                <label for="quota" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Quota <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="quota" id="quota" 
                                    value="{{ old('quota', $ticket->quota) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                    placeholder="e.g., 100" required min="1">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status_seating" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status_seating" id="status_seating"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                    required>
                                    <option value="available" {{ $ticket->status_seating == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold_out" {{ $ticket->status_seating == 'sold_out' ? 'selected' : '' }}>Sold Out</option>
                                    <option value="hidden" {{ $ticket->status_seating == 'hidden' ? 'selected' : '' }}>Hidden</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="bg-[#707FDD] text-white font-semibold px-8 py-3 rounded-lg hover:bg-[#5f6bc9] transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Ticket
                            </button>

                            <a href="{{ route('admin.ticketmanage') }}"
                                class="bg-gray-100 text-gray-700 font-semibold px-8 py-3 rounded-lg hover:bg-gray-200 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Logout Confirmation
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
<<<<<<< HEAD
</x-app-layout>
=======
</x-app-layout>
>>>>>>> main
