<footer class="font-dmsans w-full bg-secondary text-center text-black py-10 mt-6 mb-0">
    <div class="flex flex-row justify-center items-center gap-6 text-3xl text-black text-[16px] mb-8 mt-4">
        {{ $slot }}
    </div>
    <p>&copy; {{ date('Y') }} UriSphynx Ticket. All rights reserved.</p>
</footer>