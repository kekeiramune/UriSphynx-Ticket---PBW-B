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

        <main class="flex-1 p-8">

            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C] mb-4">
                    Transaction History
                </h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-[#5A6ACF]">
                            <tr>
<<<<<<< HEAD
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Username</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Concert</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Seating</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Quantity</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Total Amount</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">POP</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Actions</th>
=======
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">User ID</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Price</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Payment Method</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">POP</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-white">Action</th>
                                </th>
>>>>>>> main
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
<<<<<<< HEAD
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
                                                    <button type="button"
                                                        onclick="confirmApprove({{ $transaction->id_transaction }})"
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition">
                                                        Approve
                                                    </button>
                                                </form>
                                                <button onclick="confirmReject({{ $transaction->id_transaction }})"
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
=======
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
>>>>>>> main
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


    <script>
        // Show SweetAlert for session messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#22c55e',
                timer: 3000,
                timerProgressBar: true,
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444',
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: '{{ session('info') }}',
                confirmButtonColor: '#3b82f6',
            });
        @endif

        function showPaymentProof(imageUrl) {
            document.getElementById('paymentProofImage').src = imageUrl;
            document.getElementById('paymentProofModal').classList.remove('hidden');
        }

        function closePaymentProof() {
            document.getElementById('paymentProofModal').classList.add('hidden');
        }

        function confirmReject(transactionId) {
            Swal.fire({
                title: 'Reject Transaction?',
                html: `
                    <div class="text-left">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Reason for rejection (optional)</label>
                        <textarea id="rejectReason" class="swal2-input w-full" rows="4" 
                            placeholder="Enter reason for rejection..." 
                            style="height: auto; padding: 10px;"></textarea>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
                preConfirm: () => {
                    return document.getElementById('rejectReason').value;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form with rejection reason
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/transaction/${transactionId}/reject`;
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    
                    const reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'admin_notes';
                    reasonInput.value = result.value || '';
                    
                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    form.appendChild(reasonInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function confirmApprove(transactionId) {
            Swal.fire({
                title: 'Approve Transaction?',
                text: 'This will approve the transaction and generate tickets for the customer',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#9ca3af',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/transaction/${transactionId}/approve`;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
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

<<<<<<< HEAD
        // Close modals on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closePaymentProof();
            }
        });
=======
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
>>>>>>> main
    </script>
</x-app-layout>