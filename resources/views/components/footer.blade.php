<footer class="font-dmsans w-full bg-secondary text-center text-white py-4 mt-10">
    <div class="flex items-center gap-6 text-black text-[16px]">
        {{ $slot }}
    </div>
    <p>&copy; {{ date('Y') }} UriSphynx Ticket. All rights reserved.</p>
</footer>