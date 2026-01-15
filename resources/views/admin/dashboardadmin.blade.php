<x-app-layout>
<<<<<<< HEAD
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex bg-secondary relative">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
            class="fixed inset-0 bg-black/50 z-20 md:hidden"></div>
=======
    <div class="min-h-screen flex bg-secondary">
>>>>>>> main

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white text-[#273240] flex flex-col transition-transform duration-300 shadow-xl md:shadow-none md:relative">
            <div class="h-16 flex items-center justify-between px-6 text-xl font-semibold border-b">
                <span>UriSphynx Admin</span>
                <button @click="sidebarOpen = false" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <p class="px-4 text-gray-500 uppercase text-sm">Menu</p>

                <a href="{{ route('admin.dashboardadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg bg-gray-100 text-[#707FDD]">
                    <img src="{{ asset('chart.svg') }}"><span>Dashboard</span>
                </a>

                <a href="{{ route('admin.transadmin') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-200 hover:font-semibold hover:text-[#707FDD] transition">
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

            </nav>
        </aside>

        <!-- MAIN CONTENT -->
<<<<<<< HEAD
        <main class="flex-1 overflow-y-auto w-full">
            <div class="p-4 md:p-8">
                <div class="flex items-center gap-4 mb-6 md:mb-8">
                    <!-- Mobile Hamburger -->
                    <button @click="sidebarOpen = true" class="md:hidden p-2 bg-white rounded-lg shadow text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-2xl md:text-3xl font-bold text-[#273240]">Dashboard</h1>
                </div>
=======
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                <h1 class="text-3xl font-bold text-[#273240] mb-8">Dashboard</h1>
>>>>>>> main

                <!-- Revenue and Order Time Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Revenue Card -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-gray-600 text-sm mb-2">Revenue</h2>
<<<<<<< HEAD
                                <p class="text-3xl font-bold text-[#273240]">IDR
                                    {{ number_format($totalRevenue, 0, ',', '.') }}
                                </p>
                                <p class="{{ $revenueGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm mt-1">
                                    <span class="inline-flex items-center">
                                        @if($revenueGrowth >= 0)
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
=======
                                <p class="text-3xl font-bold text-[#273240]">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                                <p class="{{ $revenueGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} text-sm mt-1">
                                    <span class="inline-flex items-center">
                                        @if($revenueGrowth >= 0)
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
>>>>>>> main
                                        @endif
                                        {{ abs($revenueGrowth) }}% vs last 12 days
                                    </span>
                                </p>
<<<<<<< HEAD
                                <p class="text-gray-400 text-xs mt-2">Sales from
                                    {{ now()->subDays(11)->format('d M, Y') }} - {{ now()->format('d M, Y') }}
                                </p>
                            </div>
                            <button
                                class="px-4 py-2 text-sm text-[#707FDD] border border-[#707FDD] rounded-lg hover:bg-[#707FDD] hover:text-white transition">
=======
                                <p class="text-gray-400 text-xs mt-2">Sales from {{ now()->subDays(11)->format('d M, Y') }} - {{ now()->format('d M, Y') }}</p>
                            </div>
                            <button class="px-4 py-2 text-sm text-[#707FDD] border border-[#707FDD] rounded-lg hover:bg-[#707FDD] hover:text-white transition">
>>>>>>> main
                                View Report
                            </button>
                        </div>
                        <div class="relative h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                        <div class="flex items-center justify-center gap-6 mt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#707FDD]"></div>
                                <span class="text-sm text-gray-600">Last 12 days</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#C8CFEC]"></div>
                                <span class="text-sm text-gray-600">Previous 12 days</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Time Card -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-gray-600 text-sm mb-2">Order Time</h2>
                                <p class="text-gray-400 text-xs mt-1">From 1-20 Jan, 2026</p>
                            </div>
<<<<<<< HEAD
                            <button
                                class="px-4 py-2 text-sm text-[#707FDD] border border-[#707FDD] rounded-lg hover:bg-[#707FDD] hover:text-white transition">
=======
                            <button class="px-4 py-2 text-sm text-[#707FDD] border border-[#707FDD] rounded-lg hover:bg-[#707FDD] hover:text-white transition">
>>>>>>> main
                                View Report
                            </button>
                        </div>
                        <div class="relative h-64 flex items-center justify-center">
                            <canvas id="orderTimeChart"></canvas>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mt-6">
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    <div class="w-3 h-3 rounded-full bg-[#707FDD]"></div>
                                    <span class="text-sm text-gray-600">Afternoon</span>
                                </div>
                                <p class="text-lg font-semibold text-[#273240]">{{ $orderTimeData['afternoon'] }}%</p>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    <div class="w-3 h-3 rounded-full bg-[#9BA5D8]"></div>
                                    <span class="text-sm text-gray-600">Evening</span>
                                </div>
                                <p class="text-lg font-semibold text-[#273240]">{{ $orderTimeData['evening'] }}%</p>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 mb-1">
                                    <div class="w-3 h-3 rounded-full bg-[#C8CFEC]"></div>
                                    <span class="text-sm text-gray-600">Morning</span>
                                </div>
                                <p class="text-lg font-semibold text-[#273240]">{{ $orderTimeData['morning'] }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Ticket Sales Section -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-[#273240] mb-2">Most Ticket Sales</h2>
                    <p class="text-gray-400 text-sm mb-6">Adipiscing elit, sed do eiusmod tempor</p>
<<<<<<< HEAD

=======
                    
>>>>>>> main
                    <div class="space-y-4">
                        @php
                            $gradients = [
                                'from-yellow-400 to-orange-500',
                                'from-red-400 to-pink-500',
                                'from-pink-400 to-purple-500',
                                'from-orange-400 to-red-500',
                            ];
                        @endphp
<<<<<<< HEAD

                        @forelse($topConcerts as $index => $concert)
                            <!-- Ticket Item {{ $index + 1 }} -->
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-lg transition">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br {{ $gradients[$index % 4] }} flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($concert->concert_name, 0, 1)) }}
                                    </div>
                                    <span class="text-[#273240] font-medium">{{ $concert->concert_name }}</span>
                                </div>
                                <span class="text-gray-600 font-semibold">IDR
                                    {{ number_format($concert->ticket_price, 0, ',', '.') }}</span>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400">
                                <p>No ticket sales data available</p>
                            </div>
=======
                        
                        @forelse($topConcerts as $index => $concert)
                        <!-- Ticket Item {{ $index + 1 }} -->
                        <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-lg transition">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $gradients[$index % 4] }} flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($concert->concert_name, 0, 1)) }}
                                </div>
                                <span class="text-[#273240] font-medium">{{ $concert->concert_name }}</span>
                            </div>
                            <span class="text-gray-600 font-semibold">IDR {{ number_format($concert->ticket_price, 0, ',', '.') }}</span>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-400">
                            <p>No ticket sales data available</p>
                        </div>
>>>>>>> main
                        @endforelse
                    </div>
                </div>
            </div>
        </main>

    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<<<<<<< HEAD

=======
    
>>>>>>> main
    <script>
        // Revenue Bar Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                datasets: [
                    {
                        label: 'Last 12 days',
                        data: @json($currentPeriodData),
                        backgroundColor: '#707FDD',
                        borderRadius: 6,
                        barThickness: 12,
                    },
                    {
                        label: 'Previous 12 days',
                        data: @json($previousPeriodData),
                        backgroundColor: '#C8CFEC',
                        borderRadius: 6,
                        barThickness: 12,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#273240',
                        padding: 12,
                        cornerRadius: 8,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        callbacks: {
<<<<<<< HEAD
                            label: function (context) {
=======
                            label: function(context) {
>>>>>>> main
                                return context.dataset.label + ': IDR ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F3F4F6',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9CA3AF',
<<<<<<< HEAD
                            callback: function (value) {
=======
                            callback: function(value) {
>>>>>>> main
                                return value;
                            }
                        }
                    }
                }
            }
        });

        // Order Time Donut Chart
        const orderTimeCtx = document.getElementById('orderTimeChart').getContext('2d');
        const orderTimeChart = new Chart(orderTimeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Afternoon', 'Evening', 'Morning'],
                datasets: [{
                    data: [@json($orderTimeData['afternoon']), @json($orderTimeData['evening']), @json($orderTimeData['morning'])],
                    backgroundColor: [
                        '#707FDD',
                        '#9BA5D8',
                        '#C8CFEC'
                    ],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#273240',
                        padding: 12,
                        cornerRadius: 8,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        callbacks: {
<<<<<<< HEAD
                            label: function (context) {
=======
                            label: function(context) {
>>>>>>> main
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>

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