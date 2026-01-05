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
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">User ID</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Price</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">POP</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Action</th>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($transactions as $trx)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $trx->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $trx->user_id }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($trx->status === 'paid')
                                            <span class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                                                Paid
                                            </span>
                                        @else
                                            <span class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-sm uppercase">
                                        {{ $trx->payment_method }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-blue-500 underline">
                                        <a href="{{ asset('storage/payment_proofs/' . $trx->payment_proof) }}"
                                            target="_blank">
                                            View
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($trx->status === 'Pending' && $trx->payment_proof)
                                            <form method="POST"
                                                action="{{ route('admin.transaction.approve', $trx->id_transaction) }}">
                                                @csrf
                                                @method('PUT')

                                                <button type="button" onclick="confirmApprove(this)"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-xs">
                                                    Approve
                                                </button>
                                            </form>
                                        @elseif ($trx->status === 'Pending')
                                            <span class="text-gray-400 text-xs">
                                                Waiting for proof
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">
                                        No transactions found.
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

        function confirmApprove(button) {
            const form = button.closest('form');

            Swal.fire({
                title: 'Approve this payment?',
                text: 'Make sure the payment proof is valid.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#9ca3af',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>