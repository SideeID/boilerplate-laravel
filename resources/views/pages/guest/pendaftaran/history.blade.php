<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Riwayat Pendaftaran Magang</h1>
                <p class="text-gray-600 mt-1">Lihat status pendaftaran magang Anda</p>
            </div>
            <div>
                <a href="{{ route('guest.lowongan.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors duration-150">
                    <i data-feather="briefcase" class="w-4 h-4 mr-2"></i>
                    Lihat Lowongan
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600">
                            <th class="px-4 py-3 rounded-tl-lg">No.</th>
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Departemen</th>
                            <th class="px-4 py-3">Tanggal Daftar</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 rounded-tr-lg">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendaftarans as $index => $pendaftaran)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">{{ $pendaftarans->firstItem() + $index }}</td>
                            <td class="px-4 py-4 font-medium">{{ $pendaftaran->lowongan->posisi }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->lowongan->departemen->name ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-4">
                                @if($pendaftaran->status === 'P')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">
                                        Menunggu
                                    </span>
                                @elseif($pendaftaran->status === 'A')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                        Diterima
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-gray-600 text-sm">
                                @if($pendaftaran->status === 'P')
                                    Sedang dalam proses seleksi
                                @elseif($pendaftaran->status === 'A')
                                    Selamat! Pendaftaran Anda diterima
                                @else
                                    Mohon maaf, pendaftaran tidak memenuhi kriteria
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i data-feather="inbox" class="w-16 h-16 text-gray-300 mb-4"></i>
                                    <p class="text-gray-500 font-medium mb-2">Belum ada riwayat pendaftaran</p>
                                    <p class="text-gray-400 text-sm mb-4">Anda belum mendaftar ke lowongan manapun</p>
                                    <a href="{{ route('guest.lowongan.index') }}"
                                       class="text-orange-600 hover:text-orange-800 font-medium">
                                        Lihat Lowongan Tersedia →
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pendaftarans->hasPages())
            <div class="px-4 py-4 border-t border-gray-200">
                {{ $pendaftarans->links() }}
            </div>
            @endif
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i data-feather="info" class="w-5 h-5 text-blue-600 mr-3 mt-0.5"></i>
                <div class="text-sm text-blue-800">
                    <p class="font-medium mb-1">Informasi Status:</p>
                    <ul class="list-disc list-inside space-y-1 text-blue-700">
                        <li><strong>Menunggu:</strong> Pendaftaran sedang dalam proses review oleh admin</li>
                        <li><strong>Diterima:</strong> Selamat! Anda telah lolos seleksi magang</li>
                        <li><strong>Ditolak:</strong> Mohon maaf, pendaftaran tidak memenuhi kriteria yang ditentukan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
