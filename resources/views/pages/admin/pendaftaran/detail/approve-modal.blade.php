<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <i data-feather="check-circle" class="h-6 w-6 text-green-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Approve Pendaftaran</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menerima pendaftaran ini?
                </p>
                <p id="approve_candidate_name" class="text-sm font-bold text-gray-900 mt-2"></p>
            </div>
            <form id="approveForm" method="POST" class="mt-4">
                @csrf
                <div class="flex justify-center space-x-2">
                    <button type="button" onclick="closeApproveModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Approve
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openApproveModal(id) {
        const pendaftaran = pendaftaransData.find(p => p.id === id);
        if (!pendaftaran) return;

        document.getElementById('approveForm').action = `/admin/pendaftaran/${id}/approve`;
        document.getElementById('approve_candidate_name').textContent = pendaftaran.name;

        document.getElementById('approveModal').classList.remove('hidden');
        feather.replace();
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
    }
</script>
