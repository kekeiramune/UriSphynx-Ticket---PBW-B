<x-app-layout>
    <div class="min-h-screen flex bg-secondary">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray text-white flex flex-col">
        <!-- Logo / Title -->
        <div class="h-16 flex items-center px-6 text-xl font-semibold border-b border-slate-700">
            UriSphynx Admin
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboardadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 transition">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.transadmin') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 transition">
                <span>Transactions</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-800 tra

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-xl font-semibold text-[#1F384C]">Transaction History</h1>
                <table class="mt-5 min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-[#5A6ACF]">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Username</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Payment Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">Payment Method</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-black">POP (Proof of Payment)</th>
                        </tr>
                    </thead>

                     <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800">Yuuki</td>
                            <td class="px-4 py-3 text-sm text-gray-600"><button class="bg-green-500 text-white px-2 py-1 rounded">Success</button></td>
                            <td class="px-4 py-3 text-sm text-gray-600">Qris</td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-800">Admin</td>
                            <td class="px-4 py-3 text-sm text-gray-600"><button class="bg-yellow-500 text-white px-2 py-1 rounded">Pending</button></td>
                            <td class="px-4 py-3 text-sm text-gray-600">Dana</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>