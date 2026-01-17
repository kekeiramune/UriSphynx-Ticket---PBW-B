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
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-[#273240]">Edit Concert</h1>
                    <p class="text-gray-500 mt-1">Update concert information for {{ $concert->concert_name }}</p>
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
                    <form method="POST" action="{{ route('admin.concert.update', $concert->id_concert) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column - Image Upload -->
                            <div class="lg:col-span-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Concert Image</label>
                                <div class="flex flex-col items-center gap-4">
                                    <div id="imagePreview" class="w-full aspect-square rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden border-2 border-gray-300">
                                        @if($concert->image)
                                            <img src="{{ asset('storage/' . $concert->image) }}" 
                                                class="w-full h-full object-cover" alt="Current Image" id="currentImage">
                                        @else
                                            <span class="text-gray-400 text-center px-4">
                                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                No image
                                            </span>
                                        @endif
                                    </div>

                                    <label for="image" class="cursor-pointer bg-[#707FDD] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#5f6bc9] transition w-full text-center">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Change Image
                                    </label>

                                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                                    <p class="text-xs text-gray-500 text-center">Leave empty to keep current image<br>Supported: JPG, PNG, WEBP (Max: 2MB)</p>
                                </div>
                            </div>

                            <!-- Right Column - Form Fields -->
                            <div class="lg:col-span-2 space-y-5">
                                <!-- Concert Name -->
                                <div>
                                    <label for="concert_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Concert Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="concert_name" id="concert_name" 
                                        value="{{ old('concert_name', $concert->concert_name) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                        placeholder="e.g., LIVE TOUR - SYNK: aespa" required>
                                </div>

                                <!-- Date and Time -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="concert_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Concert Date <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" name="concert_date" id="concert_date" 
                                            value="{{ old('concert_date', $concert->concert_date) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            required>
                                    </div>

                                    <div>
                                        <label for="concert_time" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Concert Time <span class="text-red-500">*</span>
                                        </label>
                                        <input type="time" name="concert_time" id="concert_time" 
                                            value="{{ old('concert_time', $concert->concert_time) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            required>
                                    </div>
                                </div>

                                <!-- Venue and City -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="venue" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Venue <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="venue" id="venue" 
                                            value="{{ old('venue', $concert->venue) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            placeholder="e.g., Gelora Bung Karno" required>
                                    </div>

                                    <div>
                                        <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">
                                            City <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="city" id="city" 
                                            value="{{ old('city', $concert->city) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            placeholder="e.g., JAKARTA" required>
                                    </div>
                                </div>

                                <!-- Status and Category -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="status_concert" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Status <span class="text-red-500">*</span>
                                        </label>
                                        <select name="status_concert" id="status_concert"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            required>
                                            <option value="Upcoming" {{ old('status_concert', $concert->status_concert) == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                                            <option value="Ongoing" {{ old('status_concert', $concert->status_concert) == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                            <option value="Finished" {{ old('status_concert', $concert->status_concert) == 'Finished' ? 'selected' : '' }}>Finished</option>
                                            <option value="Cancelled" {{ old('status_concert', $concert->status_concert) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Category <span class="text-red-500">*</span>
                                        </label>
                                        <select name="category_id" id="category_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                            required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->idgroup }}" 
                                                    {{ old('category_id', $concert->category_id) == $category->idgroup ? 'selected' : '' }}>
                                                    {{ $category->groupname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="bg-[#707FDD] text-white font-semibold px-8 py-3 rounded-lg hover:bg-[#5f6bc9] transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Concert
                            </button>

                            <a href="{{ route('admin.concertmanage') }}"
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
        // Image Preview Functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').innerHTML = 
                        '<img src="' + e.target.result + '" class="w-full h-full object-cover" alt="Preview">';
                }
                reader.readAsDataURL(file);
            }
        });

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
