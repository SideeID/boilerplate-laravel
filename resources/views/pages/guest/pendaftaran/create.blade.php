<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('guest.lowongan.show', $lowongan->id) }}"
               class="text-blue-600 hover:text-blue-800 inline-flex items-center mb-4">
                <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
                Kembali ke Detail Lowongan
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-orange-400 p-6">
                <h1 class="text-2xl font-bold text-white">Form Pendaftaran Magang</h1>
                <p class="text-white mt-1">{{ $lowongan->posisi }} - {{ $lowongan->departemen->name ?? '-' }}</p>
            </div>

            <form action="{{ route('guest.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                <input type="hidden" name="id_lowongan" value="{{ $lowongan->id }}">

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
                @endif

                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Data Pribadi</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Masukkan nama lengkap">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="gender" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="dob" value="{{ old('dob') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                @error('dob')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                                <textarea name="address" required rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                          placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_telp" value="{{ old('no_telp') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Contoh: 08123456789">
                                @error('no_telp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Data Akademik</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Universitas <span class="text-red-500">*</span></label>
                                <input type="text" name="university" value="{{ old('university') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Nama universitas">
                                @error('university')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan <span class="text-red-500">*</span></label>
                                <input type="text" name="major" value="{{ old('major') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Contoh: Teknik Informatika">
                                @error('major')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">IPK <span class="text-red-500">*</span></label>
                                <input type="number" name="ipk" value="{{ old('ipk') }}" required min="0" max="4" step="0.01"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                       placeholder="Contoh: 3.50">
                                @error('ipk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Document Upload -->
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Upload Dokumen</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CV/Resume (PDF, Max: 2MB) <span class="text-red-500">*</span></label>
                            <input type="file" name="cv_file" required accept=".pdf"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal ukuran: 2MB</p>
                            @error('cv_file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-8 border-t border-gray-200 pt-6">
                    <a href="{{ route('guest.lowongan.show', $lowongan->id) }}"
                       class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
