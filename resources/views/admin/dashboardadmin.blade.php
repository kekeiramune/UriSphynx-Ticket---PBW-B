<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                <h3 class="text-lg font-bold mb-4">
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-600 mb-6">
                    You are logged in as <span class="font-semibold">Admin</span>.
                </p>

                <div class="mb-5 p-6 justify-between bg-[#5A6ACF] text-white rounded-lg">
                    <h2 class="text-xl">Revenue</h2>
                    <h1 class="text-2xl font-semibold">{{ $revenue ?? 0 }}</h1>
                    <button class="mt-2 px-4 py-2 bg-white border border-[#DDE4F0] text-[#5A6ACF] rounded hover:bg-gray-300 hover:text-"><a href="">View Report</a></button>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="p-4 bg-gray-100 rounded">
                        <p class="text-sm text-gray-500">Total Users</p>
                        <p class="text-2xl font-bold">{{ $users ?? 0 }}</p>
                    </div>

                    <div class="p-4 bg-gray-100 rounded">
                        <p class="text-sm text-gray-500">Categories</p>
                        <p class="text-2xl font-bold">{{ $categories ?? 0 }}</p>
                    </div>

                    <div class="p-4 bg-gray-100 rounded">
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="text-2xl font-bold text-green-600">Active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
