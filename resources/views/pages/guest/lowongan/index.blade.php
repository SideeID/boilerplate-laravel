<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Lowongan Magang</h1>
            <p class="text-gray-600 mt-2">Temukan lowongan magang yang sesuai dengan minat Anda</p>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Lowongan Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lowongans as $lowongan)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $lowongan->posisi }}</h3>
                            <p class="text-sm text-gray-600">{{ $lowongan->departemen->name ?? '-' }}</p>
                        </div>
                        <div class="ml-4">
                            @php
                                $sisaKuota = $lowongan->quota - $lowongan->accepted_count;
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $sisaKuota > 0 ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                <i data-feather="users" class="w-3 h-3 mr-1"></i>
                                {{ $sisaKuota }} sisa kuota
                            </span>
                        </div>
                    </div>

                    <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                        {{ $lowongan->deskripsi }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <span class="text-xs text-gray-500">
                            <i data-feather="calendar" class="w-3 h-3 inline"></i>
                            {{ $lowongan->created_at->diffForHumans() }}
                        </span>
                        <a href="{{ route('guest.lowongan.show', $lowongan->id) }}"
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                            Lihat Detail
                            <i data-feather="arrow-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i data-feather="inbox" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                <p class="text-gray-500">Belum ada lowongan tersedia saat ini</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($lowongans->hasPages())
        <div class="mt-8">
            {{ $lowongans->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
