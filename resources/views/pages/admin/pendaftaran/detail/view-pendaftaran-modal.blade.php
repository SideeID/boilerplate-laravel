<!-- View Pendaftaran Modal -->
<div id="viewPendaftaranModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900">Detail Pendaftaran</h3>
            <button onclick="closeViewPendaftaranModal()" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <p id="detail_name" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <p id="detail_gender" class="text-gray-900"></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <p id="detail_dob" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                    <p id="detail_no_telp" class="text-gray-900"></p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <p id="detail_address" class="text-gray-900"></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Universitas</label>
                    <p id="detail_university" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                    <p id="detail_major" class="text-gray-900"></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">IPK</label>
                    <p id="detail_ipk" class="text-gray-900"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi yang Dilamar</label>
                    <p id="detail_posisi" class="text-gray-900"></p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <p id="detail_status" class="text-gray-900"></p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CV</label>
                <a id="detail_cv_link" href="#" target="_blank"
                   class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <i data-feather="download" class="w-4 h-4 mr-1"></i>
                    Unduh CV
                </a>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="button" onclick="closeViewPendaftaranModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openViewPendaftaranModal(id) {
        const pendaftaran = pendaftaransData.find(p => p.id === id);
        if (!pendaftaran) return;

        document.getElementById('detail_name').textContent = pendaftaran.name;
        document.getElementById('detail_gender').textContent = pendaftaran.gender === 'male' ? 'Laki-laki' : 'Perempuan';
        document.getElementById('detail_dob').textContent = new Date(pendaftaran.dob).toLocaleDateString('id-ID');
        document.getElementById('detail_no_telp').textContent = pendaftaran.no_telp;
        document.getElementById('detail_address').textContent = pendaftaran.address;
        document.getElementById('detail_university').textContent = pendaftaran.university;
        document.getElementById('detail_major').textContent = pendaftaran.major;
        document.getElementById('detail_ipk').textContent = parseFloat(pendaftaran.ipk).toFixed(2);
        document.getElementById('detail_posisi').textContent = pendaftaran.lowongan?.posisi || '-';

        const statusText = pendaftaran.status === 'P' ? 'Pending' :
                          (pendaftaran.status === 'A' ? 'Diterima' : 'Ditolak');
        document.getElementById('detail_status').textContent = statusText;

        document.getElementById('detail_cv_link').href = `/storage/${pendaftaran.path_cv}`;

        document.getElementById('viewPendaftaranModal').classList.remove('hidden');
        feather.replace();
    }

    function closeViewPendaftaranModal() {
        document.getElementById('viewPendaftaranModal').classList.add('hidden');
    }
</script>
