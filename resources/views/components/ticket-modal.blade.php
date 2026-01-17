<div x-data="{ showTicket: false, selectedTicket: null }"
    @open-ticket.window="showTicket = true; selectedTicket = $event.detail" @keydown.escape.window="showTicket = false">
    <!-- Modal Backdrop -->
    <div x-show="showTicket" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        @click="showTicket = false" style="display: none;">
        <!-- Modal Content -->
        <div @click.stop x-show="showTicket" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <template x-if="selectedTicket">
                <div class="p-8">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">E-Ticket</h2>
                        <button @click="showTicket = false" class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Concert Info -->
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-6 text-white mb-6">
                        <h3 class="text-2xl font-bold mb-2" x-text="selectedTicket.concert_name"></h3>
                        <div class="space-y-1 text-purple-100">
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span x-text="selectedTicket.concert_date"></span>
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span x-text="selectedTicket.venue + ', ' + selectedTicket.city"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Ticket Details -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Ticket Code</p>
                            <p class="font-mono font-bold text-lg" x-text="selectedTicket.ticket_code"></p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Seating Category</p>
                            <p class="font-bold text-lg" x-text="selectedTicket.seating_name"></p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Ticket Holder</p>
                            <p class="font-bold text-lg" x-text="selectedTicket.user_name"></p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-1">Purchase Date</p>
                            <p class="font-bold text-lg" x-text="selectedTicket.purchase_date"></p>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div class="bg-gray-50 rounded-2xl p-6 text-center mb-6">
                        <p class="text-sm text-gray-500 mb-4">Scan this QR code at the venue</p>
                        <div class="flex justify-center">
                            <img :src="selectedTicket.qr_code_url" alt="QR Code"
                                class="w-64 h-64 border-4 border-white shadow-lg rounded-xl">
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="flex justify-center mb-6">
                        <span class="px-6 py-2 rounded-full text-sm font-semibold" :class="{
                                'bg-green-100 text-green-700': selectedTicket.status === 'active',
                                'bg-gray-100 text-gray-700': selectedTicket.status === 'used',
                                'bg-red-100 text-red-700': selectedTicket.status === 'expired'
                            }" x-text="selectedTicket.status.toUpperCase()"></span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button @click="window.print()"
                            class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                </path>
                            </svg>
                            Print Ticket
                        </button>
                        <button @click="showTicket = false"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-xl transition">
                            Close
                        </button>
                    </div>

                    <!-- Important Notice -->
                    <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <p class="text-sm text-yellow-800">
                            <strong>Important:</strong> Please bring a valid ID and this e-ticket (printed or digital)
                            to the venue.
                        </p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>