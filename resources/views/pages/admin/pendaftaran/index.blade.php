<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pendaftaran</h1>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- Statistics -->
        <div class="grid grid-cols-12 gap-6 mb-6">
            <div class="col-span-12 sm:col-span-4">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i data-feather="clock" class="w-8 h-8 text-yellow-600 mr-3"></i>
                        <div>
                            <p class="text-sm text-yellow-600">Pending</p>
                            <p class="text-2xl font-bold text-yellow-700">{{ $statistics['pending'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i data-feather="check-circle" class="w-8 h-8 text-green-600 mr-3"></i>
                        <div>
                            <p class="text-sm text-green-600">Diterima</p>
                            <p class="text-2xl font-bold text-green-700">{{ $statistics['accepted'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i data-feather="x-circle" class="w-8 h-8 text-red-600 mr-3"></i>
                        <div>
                            <p class="text-sm text-red-600">Ditolak</p>
                            <p class="text-2xl font-bold text-red-700">{{ $statistics['rejected'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600">
                            <th class="px-4 py-3 rounded-l-lg">No.</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Universitas</th>
                            <th class="px-4 py-3">IPK</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 rounded-r-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendaftarans as $index => $pendaftaran)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">{{ $pendaftarans->firstItem() + $index }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->name }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->lowongan->posisi }}</td>
                            <td class="px-4 py-4">{{ $pendaftaran->university }}</td>
                            <td class="px-4 py-4">{{ number_format($pendaftaran->ipk, 2) }}</td>
                            <td class="px-4 py-4">
                                @if($pendaftaran->status === 'P')
                                <span class="px-3 py-1 text-white bg-yellow-500 rounded-full text-xs">Pending</span>
                                @elseif($pendaftaran->status === 'A')
                                <span class="px-3 py-1 text-white bg-green-500 rounded-full text-xs">Diterima</span>
                                @else
                                <span class="px-3 py-1 text-white bg-red-500 rounded-full text-xs">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openViewPendaftaranModal({{ $pendaftaran->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="eye" class="w-5 h-5 text-gray-500"></i>
                                    </button>
                                    @if($pendaftaran->status === 'P')
                                    <button onclick="openApproveModal({{ $pendaftaran->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="check" class="w-5 h-5 text-green-500"></i>
                                    </button>
                                    <button onclick="openRejectModal({{ $pendaftaran->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="x" class="w-5 h-5 text-red-500"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data pendaftaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $pendaftarans->links() }}
            </div>
        </div>
    </div>

    <!-- Include Modals -->
    @include('pages.admin.pendaftaran.detail.view-pendaftaran-modal')
    @include('pages.admin.pendaftaran.detail.approve-modal')
    @include('pages.admin.pendaftaran.detail.reject-modal')

    <script>
        const pendaftaransData = @json($pendaftarans->items());
    </script>
</x-app-layout>
