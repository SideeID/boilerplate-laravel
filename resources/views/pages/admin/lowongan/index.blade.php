<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Master Lowongan</h1>
            <button onclick="openAddModal()"
                    class="bg-orange-400 hover:bg-orange-500 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                <i data-feather="plus" class="w-4 h-4 inline"></i>
                Tambah Lowongan
            </button>
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

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-600">
                            <th class="px-4 py-3 rounded-l-lg">No.</th>
                            <th class="px-4 py-3">Departemen</th>
                            <th class="px-4 py-3">Posisi</th>
                            <th class="px-4 py-3">Quota</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Dibuat Oleh</th>
                            <th class="px-4 py-3 rounded-r-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($lowongans as $index => $lowongan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">{{ $lowongans->firstItem() + $index }}</td>
                            <td class="px-4 py-4">{{ $lowongan->departemen->name ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $lowongan->posisi }}</td>
                            <td class="px-4 py-4">{{ $lowongan->quota }}</td>
                            <td class="px-4 py-4">{{ Str::limit($lowongan->deskripsi, 50) }}</td>
                            <td class="px-4 py-4">{{ $lowongan->user_create ?? '-' }}</td>
                            <td class="px-4 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openViewModal({{ $lowongan->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="eye" class="w-5 h-5 text-gray-500"></i>
                                    </button>
                                    <button onclick="openEditModal({{ $lowongan->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="edit" class="w-5 h-5 text-blue-500"></i>
                                    </button>
                                    <button onclick="openDeleteModal({{ $lowongan->id }})"
                                            class="p-1 rounded-lg hover:bg-gray-100">
                                        <i data-feather="trash-2" class="w-5 h-5 text-red-500"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data lowongan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $lowongans->links() }}
            </div>
        </div>
    </div>

    <!-- Include Modals -->
    @include('pages.admin.lowongan.detail.add-lowongan-modal')
    @include('pages.admin.lowongan.detail.edit-lowongan-modal')
    @include('pages.admin.lowongan.detail.view-lowongan-modal')
    @include('pages.admin.lowongan.detail.delete-lowongan-modal')

    <script>
        const lowongansData = @json($lowongans->items());
        const departemensData = @json($departemens ?? []);
    </script>
</x-app-layout>
