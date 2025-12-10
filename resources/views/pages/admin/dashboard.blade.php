<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Dashboard Admin</h1>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-12 gap-6 mb-8">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="bg-white shadow-lg rounded-lg p-5">
                    <div class="flex items-center">
                        <div class="ml-5 mr-auto">
                            <h2 class="text-gray-600 text-sm font-medium">Total Pendaftaran</h2>
                            <p class="text-lg text-gray-800 font-semibold">{{ $statistics['total'] }}</p>
                        </div>
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-2xl">
                            <i data-feather="file-text" class="text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="bg-white shadow-lg rounded-lg p-5">
                    <div class="flex items-center">
                        <div class="ml-5 mr-auto">
                            <h2 class="text-gray-600 text-sm font-medium">Pending</h2>
                            <p class="text-lg text-gray-800 font-semibold">{{ $statistics['pending'] }}</p>
                        </div>
                        <div class="flex items-center justify-center w-10 h-10 bg-yellow-500 rounded-2xl">
                            <i data-feather="clock" class="text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="bg-white shadow-lg rounded-lg p-5">
                    <div class="flex items-center">
                        <div class="ml-5 mr-auto">
                            <h2 class="text-gray-600 text-sm font-medium">Diterima</h2>
                            <p class="text-lg text-gray-800 font-semibold">{{ $statistics['accepted'] }}</p>
                        </div>
                        <div class="flex items-center justify-center w-10 h-10 bg-green-500 rounded-2xl">
                            <i data-feather="check-circle" class="text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-3">
                <div class="bg-white shadow-lg rounded-lg p-5">
                    <div class="flex items-center">
                        <div class="ml-5 mr-auto">
                            <h2 class="text-gray-600 text-sm font-medium">Ditolak</h2>
                            <p class="text-lg text-gray-800 font-semibold">{{ $statistics['rejected'] }}</p>
                        </div>
                        <div class="flex items-center justify-center w-10 h-10 bg-red-500 rounded-2xl">
                            <i data-feather="x-circle" class="text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Pending Applications -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pendaftaran Pending Terbaru</h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600">
                            <th class="px-4 py-3 rounded-l-lg">No.</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Universitas</th>
                            <th class="px-4 py-3">IPK</th>
                            <th class="px-4 py-3 rounded-r-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPendaftarans->take(10) as $index => $pendaftaran)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">{{ $index + 1 }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->name }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->lowongan->posisi }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->university }}</td>
                            <td class="px-4 py-4">{{ number_format($pendaftaran->ipk, 2) }}</td>
                            <td class="px-4 py-4">
                                <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada pendaftaran pending
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
