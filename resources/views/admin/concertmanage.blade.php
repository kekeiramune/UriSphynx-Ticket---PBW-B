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

                <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('docblack.svg') }}"><span>Concert Management</span>
                </a>

                <a href="{{ route('admin.ticketmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('docblack.svg') }}"><span>Ticket Management</span>
                </a>

                <p class="flex-1 px-4 py-6 text-gray-500 uppercase">Others</p>

                <a href="{{ route('admin.accountmanage') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
                    <img src="{{ asset('profadmin.svg') }}"><span>Accounts</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8">

            <form action="{{ route('admin.ticket.store') }}" method="POST">
                @csrf

                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Concert Management
                </h1>

                <!-- Concert Name -->
                <div class="mt-2 mb-2">
                    <label class="font-semibold">Concert Name</label>
                    <input type="text" name="concert_name"
                        placeholder="Input Name"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 placeholder-[#5A6ACF]"
                        required>
                </div>

                <!-- Ticket Price -->
                <div class="mt-2 mb-2">
                    <label class="font-semibold">Ticket Price</label>
                    <input type="number" name="price"
                        placeholder="Input Price"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 placeholder-[#5A6ACF]"
                        required>
                </div>

                <!-- Category -->
                <div class="mt-2 mb-2">
                    <label class="font-semibold">Ticket Category</label>

                    <div x-data="{ open: false, selected: '' }" class="relative w-[500px]">
                        <input type="text"
                            x-model="selected"
                            readonly
                            placeholder="Choose Category"
                            @click="open = !open"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 placeholder-[#5A6ACF] cursor-pointer">

                        <!-- hidden value -->
                        <input type="hidden" name="category">

                        <div x-show="open" @click.outside="open = false"
                            class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                            @foreach ($categories ?? [] as $cat)
                                <div
                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                    @click="
                                        selected = '{{ $cat->name }}';
                                        $refs.hidden.value = '{{ $cat->id }}';
                                        open = false;
                                    ">
                                    {{ $cat->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quota -->
                <div class="mt-2 mb-2">
                    <label class="font-semibold">Ticket Quota</label>
                    <input type="number" name="quota"
                        placeholder="Input Quota"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 placeholder-[#5A6ACF]"
                        required>
                </div>

                <!-- Selling Period -->
                <div class="mt-8">
                    <h1 class="text-xl font-bold">Selling Period</h1>
                </div>

                <div class="mt-2 mb-2 p-8">
                    <label class="font-semibold">Start</label>
                    <input type="date" name="sell_start"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 mb-3"
                        required>

                    <label class="font-semibold">End</label>
                    <input type="date" name="sell_end"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Buttons -->
                <div class="flex gap-8 mt-4">
                    <button type="submit"
                        class="bg-white px-4 py-2 rounded-[10px] text-[#5A6ACF] hover:bg-gray-300 font-semibold">
                        Add Concert
                    </button>

                    <a href="{{ route('admin.ticketmanage') }}"
                        class="bg-white px-4 py-2 rounded-[10px] text-[#5A6ACF] hover:bg-gray-300 font-semibold">
                        Cancel
                    </a>
                </div>

            </form>

        </main>
    </div>
</x-app-layout>
