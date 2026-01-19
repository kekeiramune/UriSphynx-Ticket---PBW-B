<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black/80 py-10 px-4">
        <div class="bg-white w-full max-w-3xl rounded-2xl p-6 md:p-10 shadow-xl">

            <h1 class="text-2xl md:text-3xl font-bold mb-8">Payment Form</h1>

            <form method="POST" action="{{ route('payment.store', $concert->id_concert) }}"
                enctype="multipart/form-data">
                @csrf

                <!-- NAME -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">NAME</label>
                    <input type="text" name="name" required
                        class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-300">
                </div>

                <!-- TICKET CATEGORY -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">TICKET CATEGORY</label>
                    <select name="id_price" id="ticketSelect" required onchange="updatePrice()"
                        class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-300">
                        <option value="">- Pilih -</option>
                        @foreach($prices as $price)
                            <option value="{{ $price->id_price }}" data-price="{{ $price->ticket_price }}" 
                                {{ request('cp') == $price->id_price ? 'selected' : '' }}>
                                {{ $price->seating->name_seating ?? $price->seating->name }}
                                — Rp {{ number_format($price->ticket_price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PRICE -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">PRICE</label>
                    <input type="text" id="priceInput" readonly class="w-full border rounded-lg px-4 py-3 bg-gray-100">
                </div>

                <!-- QUANTITY -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">QUANTITY</label>
                    <input type="number" name="quantity" id="quantityInput" value="1" min="1" required 
                        onchange="updatePrice()" onkeyup="updatePrice()"
                        class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-300">
                </div>

                <!-- TOTAL -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">TOTAL</label>
                    <input type="text" id="totalInput" readonly
                        class="w-full border rounded-lg px-4 py-3 bg-gray-100 font-semibold">
                </div>

                <!-- PAYMENT METHOD -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold mb-2">PAYMENT METHOD</label>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-6">
                        <label class="flex items-center gap-2 cursor-pointer border md:border-none p-3 md:p-0 rounded-lg md:rounded-none bg-gray-50 md:bg-transparent">
                            <input type="radio" name="payment_method" value="gopay" required>
                            <span>E-Wallet (GoPay)</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer border md:border-none p-3 md:p-0 rounded-lg md:rounded-none bg-gray-50 md:bg-transparent">
                            <input type="radio" name="payment_method" value="ovo">
                            <span>OVO</span>
                        </label>

                        <label class="flex items-center gap-2 cursor-pointer border md:border-none p-3 md:p-0 rounded-lg md:rounded-none bg-gray-50 md:bg-transparent">
                            <input type="radio" name="payment_method" value="dana">
                            <span>DANA</span>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">UPLOAD PAYMENT PROOF</label>
                    <input type="file" name="payment_proof" accept="image/*" required
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <!-- SUBMIT -->
                <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-gray-800 transition">
                    Pay Now
                </button>

            </form>
        </div>
    </div>

    <script>
        function updatePrice() {
            const select = document.getElementById('ticketSelect');
            const price = select.options[select.selectedIndex].dataset.price;
            const quantity = document.getElementById('quantityInput').value || 1;

            if (!price) {
                document.getElementById('priceInput').value = '';
                document.getElementById('totalInput').value = '';
                return;
            }

            const total = price * quantity;
            const formattedPrice = new Intl.NumberFormat('id-ID').format(price);
            const formattedTotal = new Intl.NumberFormat('id-ID').format(total);

            document.getElementById('priceInput').value = 'Rp ' + formattedPrice;
            document.getElementById('totalInput').value = 'Rp ' + formattedTotal;
        }

        document.addEventListener('DOMContentLoaded', updatePrice);
    </script>
</x-app-layout>