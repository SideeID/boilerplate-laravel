<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page Header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Laporan Pendaftaran Magang</h1>
                <p class="text-gray-600 mt-1">Summary pendaftar per departemen dan status</p>
            </div>
            <div class="flex gap-2">
                <button onclick="window.print()" class="btn bg-green-500 hover:bg-green-600 text-white">
                    <i data-feather="printer" class="w-4 h-4 mr-2"></i>
                    Print Laporan
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Kuota</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $reportData->sum('total_quota') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-feather="users" class="text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $reportData->sum('total_pendaftar') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-feather="file-text" class="text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Diterima</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ $reportData->sum('diterima') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="check-circle" class="text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sisa Kuota</p>
                        <p class="text-2xl font-bold text-orange-600 mt-1">{{ $reportData->sum('sisa_quota') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i data-feather="alert-circle" class="text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Summary per Departemen</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600">
                            <th class="px-6 py-4 font-semibold">No.</th>
                            <th class="px-6 py-4 font-semibold">Departemen</th>
                            <th class="px-6 py-4 font-semibold text-center">Total Kuota</th>
                            <th class="px-6 py-4 font-semibold text-center">Total Pendaftar</th>
                            <th class="px-6 py-4 font-semibold text-center">Diterima</th>
                            <th class="px-6 py-4 font-semibold text-center">Ditolak</th>
                            <th class="px-6 py-4 font-semibold text-center">Pending</th>
                            <th class="px-6 py-4 font-semibold text-center">Sisa Kuota</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($reportData as $index => $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-800">{{ $data['departemen'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['total_quota'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['total_pendaftar'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['diterima'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['ditolak'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['pending'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold text-gray-800">{{ $data['sisa_quota'] }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <i data-feather="inbox" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                                <p class="font-medium">Belum ada data departemen</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                    @if($reportData->isNotEmpty())
                    <tfoot class="bg-gray-50">
                        <tr class="font-bold text-gray-800">
                            <td colspan="2" class="px-6 py-4 text-right">TOTAL:</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('total_quota') }}</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('total_pendaftar') }}</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('diterima') }}</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('ditolak') }}</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('pending') }}</td>
                            <td class="px-6 py-4 text-center">{{ $reportData->sum('sisa_quota') }}</td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        <!-- Detail per Departemen -->
        @foreach($reportData as $data)
        @if($data['lowongans']->isNotEmpty())
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <h3 class="text-lg font-bold text-white">Detail Lowongan - {{ $data['departemen'] }}</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left text-gray-600 text-sm">
                            <th class="px-6 py-3">No.</th>
                            <th class="px-6 py-3">Posisi</th>
                            <th class="px-6 py-3 text-center">Kuota</th>
                            <th class="px-6 py-3 text-center">Pendaftar</th>
                            <th class="px-6 py-3 text-center">Diterima</th>
                            <th class="px-6 py-3 text-center">Ditolak</th>
                            <th class="px-6 py-3 text-center">Pending</th>
                            <th class="px-6 py-3 text-center">Sisa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($data['lowongans'] as $index => $lowongan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $lowongan->posisi }}</td>
                            <td class="px-6 py-3 text-center">{{ $lowongan->quota }}</td>
                            <td class="px-6 py-3 text-center">{{ $lowongan->pendaftarans_count }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $lowongan->accepted_count }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $lowongan->rejected_count }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $lowongan->pending_count }}</td>
                            <td class="px-6 py-3 text-center font-semibold">{{ $lowongan->quota - $lowongan->accepted_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @endforeach

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i data-feather="info" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-medium mb-2">Keterangan:</p>
                    <ul class="list-disc list-inside space-y-1 text-blue-700">
                        <li><strong>Total Kuota:</strong> Jumlah total slot magang yang tersedia di departemen</li>
                        <li><strong>Total Pendaftar:</strong> Jumlah seluruh pelamar yang mendaftar</li>
                        <li><strong>Diterima:</strong> Pelamar yang lolos seleksi dan diterima</li>
                        <li><strong>Ditolak:</strong> Pelamar yang tidak lolos seleksi</li>
                        <li><strong>Pending:</strong> Pelamar yang masih dalam proses seleksi</li>
                        <li><strong>Sisa Kuota:</strong> Kuota yang masih tersedia (Total Kuota - Diterima)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn, nav, footer {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .bg-white {
                box-shadow: none !important;
            }
        }
    </style>
</x-app-layout>
