<!-- Delete Lowongan Modal -->
<div id="deleteLowonganModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i data-feather="alert-triangle" class="h-6 w-6 text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Hapus Lowongan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus lowongan ini? Tindakan ini tidak dapat dibatalkan.
                </p>
                <p id="delete_lowongan_name" class="text-sm font-bold text-gray-900 mt-2"></p>
            </div>
            <form id="deleteLowonganForm" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-2">
                    <button type="button" onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(id) {
        const lowongan = lowongansData.find(l => l.id === id);
        if (!lowongan) return;

        document.getElementById('deleteLowonganForm').action = `/admin/lowongan/${id}`;
        document.getElementById('delete_lowongan_name').textContent = `${lowongan.posisi} - ${lowongan.departemen?.name || ''}`;

        document.getElementById('deleteLowonganModal').classList.remove('hidden');
        feather.replace();
    }

    function closeDeleteModal() {
        document.getElementById('deleteLowonganModal').classList.add('hidden');
    }
</script>
