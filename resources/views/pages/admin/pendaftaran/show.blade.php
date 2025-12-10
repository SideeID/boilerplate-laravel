<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.pendaftaran.index') }}"
               class="text-blue-600 hover:text-blue-800 inline-flex items-center mb-4">
                <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
                Kembali ke Daftar Pendaftaran
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                <h1 class="text-2xl font-bold text-white mb-2">Detail Pendaftaran Magang</h1>
                <div class="flex items-center space-x-4">
                    @if($pendaftaran->status === 'P')
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                        <i data-feather="clock" class="w-4 h-4 inline mr-1"></i>
                        Pending
                    </span>
                    @elseif($pendaftaran->status === 'A')
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                        <i data-feather="check-circle" class="w-4 h-4 inline mr-1"></i>
                        Diterima
                    </span>
                    @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                        <i data-feather="x-circle" class="w-4 h-4 inline mr-1"></i>
                        Ditolak
                    </span>
                    @endif
                    <span class="text-white text-sm">
                        <i data-feather="calendar" class="w-4 h-4 inline mr-1"></i>
                        {{ $pendaftaran->created_at->format('d M Y H:i') }}
                    </span>
                </div>
            </div>

            <div class="p-8">
                <!-- Informasi Lowongan -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i data-feather="briefcase" class="w-5 h-5 mr-2 text-blue-600"></i>
                        Informasi Lowongan
                    </h2>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Posisi</p>
                                <p class="font-semibold text-gray-900">{{ $pendaftaran->lowongan->posisi }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Departemen</p>
                                <p class="font-semibold text-gray-900">{{ $pendaftaran->lowongan->departemen->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i data-feather="user" class="w-5 h-5 mr-2 text-blue-600"></i>
                        Data Pribadi
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">Nama Lengkap</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->name }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">Jenis Kelamin</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">Tanggal Lahir</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->dob->format('d M Y') }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">No. Telepon</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->no_telp }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3 md:col-span-2">
                            <p class="text-sm text-gray-600">Alamat</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Akademik -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i data-feather="book" class="w-5 h-5 mr-2 text-blue-600"></i>
                        Data Akademik
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">Universitas</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->university }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">Program Studi</p>
                            <p class="font-medium text-gray-900">{{ $pendaftaran->major }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <p class="text-sm text-gray-600">IPK</p>
                            <p class="font-medium text-gray-900">{{ number_format($pendaftaran->ipk, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- CV -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i data-feather="file-text" class="w-5 h-5 mr-2 text-blue-600"></i>
                        Curriculum Vitae
                    </h2>
                    @if($pendaftaran->path_cv)
                    <a href="{{ Storage::url($pendaftaran->path_cv) }}"
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors">
                        <i data-feather="download" class="w-4 h-4 mr-2"></i>
                        Download CV
                    </a>
                    @else
                    <p class="text-gray-500 italic">CV tidak tersedia</p>
                    @endif
                </div>

                <!-- Actions -->
                @if($pendaftaran->status === 'P')
                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Aksi Seleksi</h2>
                    <div class="flex space-x-4">
                        <form action="{{ route('admin.pendaftaran.approve', $pendaftaran->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menerima pendaftaran ini?')"
                                    class="w-full inline-flex justify-center items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors">
                                <i data-feather="check-circle" class="w-5 h-5 mr-2"></i>
                                Terima Pendaftar
                            </button>
                        </form>
                        <form action="{{ route('admin.pendaftaran.reject', $pendaftaran->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')"
                                    class="w-full inline-flex justify-center items-center px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                                <i data-feather="x-circle" class="w-5 h-5 mr-2"></i>
                                Tolak Pendaftar
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="border-t border-gray-200 pt-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                        <i data-feather="info" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                        <p class="text-gray-600">
                            Pendaftaran ini telah
                            <span class="font-semibold">{{ $pendaftaran->status === 'A' ? 'diterima' : 'ditolak' }}</span>
                            pada {{ $pendaftaran->updated_at->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
