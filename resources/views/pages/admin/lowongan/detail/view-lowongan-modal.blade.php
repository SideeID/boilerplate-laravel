<!-- View Lowongan Modal -->
<div id="viewLowonganModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">Detail Lowongan</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                    <p id="view_departemen" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                    <p id="view_posisi" class="text-gray-900"></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quota</label>
                    <p id="view_quota" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat Oleh</label>
                    <p id="view_user_create" class="text-gray-900"></p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <p id="view_deskripsi" class="text-gray-900"></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dibuat Pada</label>
                    <p id="view_created_at" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Diupdate Pada</label>
                    <p id="view_updated_at" class="text-gray-900"></p>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="button" onclick="closeViewModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openViewModal(id) {
        const lowongan = lowongansData.find(l => l.id === id);
        if (!lowongan) return;

        document.getElementById('view_departemen').textContent = lowongan.departemen?.name || '-';
        document.getElementById('view_posisi').textContent = lowongan.posisi;
        document.getElementById('view_quota').textContent = lowongan.quota;
        document.getElementById('view_deskripsi').textContent = lowongan.deskripsi;
        document.getElementById('view_user_create').textContent = lowongan.user_create || '-';
        document.getElementById('view_created_at').textContent = new Date(lowongan.created_at).toLocaleString('id-ID');
        document.getElementById('view_updated_at').textContent = new Date(lowongan.updated_at).toLocaleString('id-ID');

        document.getElementById('viewLowonganModal').classList.remove('hidden');
        feather.replace();
    }

    function closeViewModal() {
        document.getElementById('viewLowonganModal').classList.add('hidden');
    }
</script>
