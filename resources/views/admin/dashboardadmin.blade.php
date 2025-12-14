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
