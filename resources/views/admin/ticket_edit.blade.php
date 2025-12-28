<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-semibold mb-4">
            Edit Ticket – {{ $ticket->concert_name }} ({{ $ticket->name_seating }})
        </h1>

        <form method="POST" action="{{ route('admin.ticket.update', $ticket->id_price) }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Price</label>
                <input type="number" name="ticket_price"
                       value="{{ $ticket->ticket_price }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Quota</label>
                <input type="number" name="quota"
                       value="{{ $ticket->quota }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Status</label>
                <select name="status_seating" class="w-full border rounded px-3 py-2">
                    <option value="available" {{ $ticket->status_seating == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="sold_out" {{ $ticket->status_seating == 'sold_out' ? 'selected' : '' }}>Sold Out</option>
                    <option value="hidden" {{ $ticket->status_seating == 'hidden' ? 'selected' : '' }}>Hidden</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.ticketmanage') }}" class="px-4 py-2 border rounded">
                    Cancel
                </a>
                <button class="px-4 py-2 bg-indigo-500 text-white rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
