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
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Transaction History
                </h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#5A6ACF]">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Username</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Concert</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Seating</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Quantity</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Total Amount</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">POP</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($transactions as $transaction)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">{{ $transaction->user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $transaction->concert->concert_name }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $transaction->concertPrice->seating->name_seating ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $transaction->quantity }}</td>
                                    <td class="px-4 py-3 text-sm">Rp
                                        {{ number_format($transaction->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($transaction->status === 'Pending')
                                            @if($transaction->admin_notes)
                                                <span class="bg-red-500 text-white px-3 py-1 rounded text-xs">Revision Needed</span>
                                            @else
                                                <span class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">Pending</span>
                                            @endif
                                        @elseif($transaction->status === 'Paid')
                                            <span class="bg-green-500 text-white px-3 py-1 rounded text-xs">Paid</span>
                                        @else
                                            <span
                                                class="bg-gray-500 text-white px-3 py-1 rounded text-xs">{{ $transaction->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $transaction->payment_method }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($transaction->payment_proof)
                                            <button
                                                onclick="showPaymentProof('{{ asset('storage/' . $transaction->payment_proof) }}')"
                                                class="text-blue-500 underline cursor-pointer hover:text-blue-700">
                                                View
                                            </button>
                                        @else
                                            <span class="text-gray-400">No proof</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($transaction->status === 'Pending')
                                            <div class="flex gap-2">
                                                <form method="POST"
                                                    action="{{ route('admin.transaction.approve', $transaction->id_transaction) }}"
                                                    class="inline">

                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        onclick="return confirm('Approve transaksi ini dan generate tiket?')"
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition">
                                                        Approve
                                                    </button>
                                                </form>
                                                <button onclick="showRejectModal({{ $transaction->id_transaction }})"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                                    Reject
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">Processed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </div>
    <!-- Payment Proof Modal -->
    <div id="paymentProofModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Payment Proof</h3>
                <button onclick="closePaymentProof()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <img id="paymentProofImage" src="" alt="Payment Proof" class="w-full h-auto rounded">
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-xl font-semibold mb-4">Reject Transaction</h3>
            <form id="rejectForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for rejection (optional)</label>
                    <textarea name="admin_notes" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500"
                        placeholder="Enter reason for rejection..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg transition">
                        Confirm Reject
                    </button>
                    <button type="button" onclick="closeRejectModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 rounded-lg transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPaymentProof(imageUrl) {
            document.getElementById('paymentProofImage').src = imageUrl;
            document.getElementById('paymentProofModal').classList.remove('hidden');
        }

        function closePaymentProof() {
            document.getElementById('paymentProofModal').classList.add('hidden');
        }

        function showRejectModal(transactionId) {
            const form = document.getElementById('rejectForm');
            form.action = `/admin/transaction/${transactionId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

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

        // Close modals on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closePaymentProof();
                closeRejectModal();
            }
        });
    </script>
</x-app-layout>