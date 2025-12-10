<!-- Edit Lowongan Modal -->
<div id="editLowonganModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">Edit Lowongan</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-6 h-6"></i>
            </button>
        </div>

        <form id="editLowonganForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                    <select name="dept_id" id="edit_dept_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Pilih Departemen</option>
                        @foreach($departemens ?? [] as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Posisi</label>
                    <input type="text" name="posisi" id="edit_posisi" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quota</label>
                    <input type="number" name="quota" id="edit_quota" required min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" required rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id) {
        const lowongan = lowongansData.find(l => l.id === id);
        if (!lowongan) return;

        document.getElementById('editLowonganForm').action = `/admin/lowongan/${id}`;
        document.getElementById('edit_dept_id').value = lowongan.dept_id;
        document.getElementById('edit_posisi').value = lowongan.posisi;
        document.getElementById('edit_quota').value = lowongan.quota;
        document.getElementById('edit_deskripsi').value = lowongan.deskripsi;

        document.getElementById('editLowonganModal').classList.remove('hidden');
        feather.replace();
    }

    function closeEditModal() {
        document.getElementById('editLowonganModal').classList.add('hidden');
    }
</script>
