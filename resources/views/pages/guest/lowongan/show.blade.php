<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('guest.lowongan.index') }}"
               class="text-blue-600 hover:text-blue-800 inline-flex items-center mb-4">
                <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
                Kembali ke Daftar Lowongan
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $lowongan->posisi }}</h1>
                        <p class="text-lg text-gray-600">{{ $lowongan->departemen->name ?? '-' }}</p>
                    </div>
                    @php
                        $sisaKuota = $lowongan->quota - $lowongan->accepted_count;
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $sisaKuota > 0 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                        <i data-feather="users" class="w-4 h-4 mr-2"></i>
                        {{ $sisaKuota }} sisa kuota
                    </span>
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Deskripsi Lowongan</h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $lowongan->deskripsi }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Informasi Tambahan</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Departemen</p>
                            <p class="font-medium text-gray-900">{{ $lowongan->departemen->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Kuota</p>
                            <p class="font-medium text-gray-900">{{ $lowongan->quota }} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Yang Diterima</p>
                            <p class="font-medium text-green-600">{{ $lowongan->accepted_count }} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Sisa Kuota</p>
                            <p class="font-medium {{ $sisaKuota > 0 ? 'text-blue-600' : 'text-red-600' }}">{{ $sisaKuota }} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Dibuat</p>
                            <p class="font-medium text-gray-900">{{ $lowongan->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Terakhir Diupdate</p>
                            <p class="font-medium text-gray-900">{{ $lowongan->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                @if($sisaKuota > 0)
                <div class="border-t border-gray-200 pt-6">
                    <a href="{{ route('guest.pendaftaran.create', $lowongan->id) }}"
                       class="w-full inline-flex justify-center items-center px-6 py-3 bg-orange-400 hover:bg-orange-500 text-white font-medium rounded-lg transition-colors">
                        <i data-feather="file-text" class="w-5 h-5 mr-2"></i>
                        Daftar Sekarang
                    </a>
                </div>
                @else
                <div class="border-t border-gray-200 pt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                        <i data-feather="alert-circle" class="w-8 h-8 text-red-500 mx-auto mb-2"></i>
                        <p class="text-red-700 font-medium">Kuota Sudah Penuh</p>
                        <p class="text-red-600 text-sm mt-1">Maaf, lowongan ini sudah tidak menerima pendaftar baru</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
