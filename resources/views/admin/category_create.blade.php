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
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('doc.svg') }}" alt=""><span>Ticket Management</span>
                </a>
                
                <a href="{{ route('admin.categorymanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
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
                    <h1 class="text-3xl font-bold text-[#273240]">Add New Category</h1>
                    <p class="text-gray-500 mt-1">Create a new artist or group category</p>
                </div>

                <!-- Success/Error Messages -->


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
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column - Image Upload -->
                            <div class="lg:col-span-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Category Image</label>
                                <div class="flex flex-col items-center gap-4">
                                    <div id="imagePreview" class="w-full aspect-square rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300">
                                        <span class="text-gray-400 text-center px-4">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            No image selected
                                        </span>
                                    </div>

                                    <label for="groupimg" class="cursor-pointer bg-[#707FDD] text-white font-semibold px-6 py-3 rounded-lg hover:bg-[#5f6bc9] transition w-full text-center">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        Upload Image
                                    </label>

                                    <input type="file" name="groupimg" id="groupimg" class="hidden" accept="image/*" required>
                                    <p class="text-xs text-gray-500 text-center">Supported: JPG, PNG, WEBP (Max: 2MB)</p>
                                </div>
                            </div>

                            <!-- Right Column - Form Fields -->
                            <div class="lg:col-span-2 space-y-5">
                                <!-- Group Name -->
                                <div>
                                    <label for="groupname" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Group Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="groupname" id="groupname" value="{{ old('groupname') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition"
                                        placeholder="e.g., BTS, BLACKPINK" required>
                                </div>

                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Type of Group <span class="text-red-500">*</span>
                                    </label>
                                    <select name="type" id="type" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Boygroup" {{ old('type') == 'Boygroup' ? 'selected' : '' }}>Boygroup</option>
                                        <option value="Girlgroup" {{ old('type') == 'Girlgroup' ? 'selected' : '' }}>Girlgroup</option>
                                        <option value="Co-ed group" {{ old('type') == 'Co-ed group' ? 'selected' : '' }}>Co-ed group</option>
                                        <option value="Band" {{ old('type') == 'Band' ? 'selected' : '' }}>Band</option>
                                        <option value="Soloist" {{ old('type') == 'Soloist' ? 'selected' : '' }}>Soloist</option>
                                    </select>
                                </div>

                                <!-- Debut Year -->
                                <div>
                                    <label for="debut" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Debut Era <span class="text-red-500">*</span>
                                    </label>
                                    <select name="debut" id="debut" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition" required>
                                        <option value="" disabled selected>Select Era</option>
                                        <option value="1st Gen / pre-2010" {{ old('debut') == '1st Gen / pre-2010' ? 'selected' : '' }}>1st Gen / pre-2010</option>
                                        <option value="2010-2015" {{ old('debut') == '2010-2015' ? 'selected' : '' }}>2010-2015</option>
                                        <option value="2016-2020" {{ old('debut') == '2016-2020' ? 'selected' : '' }}>2016-2020</option>
                                        <option value="2021-present" {{ old('debut') == '2021-present' ? 'selected' : '' }}>2021-present</option>
                                    </select>
                                </div>

                                <!-- Agency -->
                                <div>
                                    <label for="agency" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Agency <span class="text-red-500">*</span>
                                    </label>
                                    <select name="agency" id="agency" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition" required>
                                        <option value="" disabled selected>Select Agency</option>
                                        <option value="HYBE" {{ old('agency') == 'HYBE' ? 'selected' : '' }}>HYBE</option>
                                        <option value="JYP" {{ old('agency') == 'JYP' ? 'selected' : '' }}>JYP</option>
                                        <option value="SM" {{ old('agency') == 'SM' ? 'selected' : '' }}>SM</option>
                                        <option value="YG" {{ old('agency') == 'YG' ? 'selected' : '' }}>YG</option>
                                    </select>
                                </div>

                                <!-- Popularity -->
                                <div>
                                    <label for="popular" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Popularity/Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="popular" id="popular" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#707FDD] focus:border-transparent transition" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="mostp" {{ old('popular') == 'mostp' ? 'selected' : '' }}>Most Popular</option>
                                        <option value="trend" {{ old('popular') == 'trend' ? 'selected' : '' }}>Trending</option>
                                        <option value="new" {{ old('popular') == 'new' ? 'selected' : '' }}>New Comers</option>
                                    </select>
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
                                Create Category
                            </button>

                            <a href="{{ route('admin.categorymanage') }}"
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
        document.getElementById('groupimg').addEventListener('change', function(e) {
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
</x-app-layout>
