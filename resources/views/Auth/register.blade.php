<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi Seller</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <a href="/"><img src="{{ asset('build/assets/images/toekoe.png') }}" alt="logo"
                        class="w-32 mx-auto mb-4" /></a>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Bergabunglah dengan TOEKOE</h1>
                <p class="text-gray-600 mt-2">Daftarkan toko Anda dan mulai berjualan sekarang</p>
            </div>

            <div class="container mx-auto px-4 py-8">
                <!-- Centered Card Container -->
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</h3>
                                        <ul class="text-sm text-red-700 space-y-1 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6" id="registrationForm">
                            @csrf

                            <!-- Section 1: Informasi Toko -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-purple-500">
                                    <i class="fas fa-store mr-2 text-purple-600"></i>Informasi Toko
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Toko <span
                                                class="text-red-500">*</span></label>
                                        <input name="nama_toko" type="text" required value="{{ old('nama_toko') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('nama_toko') border-red-500 @enderror"
                                            placeholder="Contoh: Toko Elektronik Jaya" />
                                        @error('nama_toko')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat
                                            <span class="text-red-500">*</span></label>
                                        <textarea name="deskripsi_singkat" required
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('deskripsi_singkat') border-red-500 @enderror"
                                            placeholder="Jelaskan singkat tentang toko Anda" rows="3">{{ old('deskripsi_singkat') }}</textarea>
                                        @error('deskripsi_singkat')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Data Pribadi Pemilik/PIC -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-blue-500">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>Data Pribadi (Pemilik/PIC)
                                </h3>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                                <span class="text-red-500">*</span></label>
                                            <input name="nama" type="text" required value="{{ old('nama') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('nama') border-red-500 @enderror"
                                                placeholder="Nama lengkap" />
                                            @error('nama')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Handphone
                                                <span class="text-red-500">*</span></label>
                                            <input name="no_hp" type="tel" required value="{{ old('no_hp') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('no_hp') border-red-500 @enderror"
                                                placeholder="08xxxxxxxxxx" />
                                            @error('no_hp')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                                class="text-red-500">*</span></label>
                                        <input name="email" type="email" required value="{{ old('email') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('email') border-red-500 @enderror"
                                            placeholder="email@example.com" />
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">No. KTP <span
                                                class="text-red-500">*</span></label>
                                        <input name="no_ktp" type="text" required value="{{ old('no_ktp') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('no_ktp') border-red-500 @enderror"
                                            placeholder="16 digit nomor KTP" maxlength="16" />
                                        @error('no_ktp')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Alamat -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-green-500">
                                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>Alamat
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat (Nama Jalan)
                                            <span class="text-red-500">*</span></label>
                                        <input name="alamat" type="text" required value="{{ old('alamat') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('alamat') border-red-500 @enderror"
                                            placeholder="Jalan, No. Rumah" />
                                        @error('alamat')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">RT <span
                                                    class="text-red-500">*</span></label>
                                            <input name="rt" type="text" required
                                                value="{{ old('rt') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('rt') border-red-500 @enderror"
                                                placeholder="001" maxlength="3" />
                                            @error('rt')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">RW <span
                                                    class="text-red-500">*</span></label>
                                            <input name="rw" type="text" required
                                                value="{{ old('rw') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('rw') border-red-500 @enderror"
                                                placeholder="001" maxlength="3" />
                                            @error('rw')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kelurahan
                                            <span class="text-red-500">*</span></label>
                                        <input name="nama_kelurahan" type="text" required
                                            value="{{ old('nama_kelurahan') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('nama_kelurahan') border-red-500 @enderror"
                                            placeholder="Kelurahan" />
                                        @error('nama_kelurahan')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span
                                                    class="text-red-500">*</span></label>
                                            <select name="provinsi" required id="selectProvinsi"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('provinsi') border-red-500 @enderror">
                                                <option value="">-- Pilih Provinsi --</option>
                                                @foreach (array_keys(config('locations')) as $prov)
                                                    <option value="{{ $prov }}"
                                                        {{ old('provinsi') == $prov ? 'selected' : '' }}>
                                                        {{ $prov }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota
                                                <span class="text-red-500">*</span></label>
                                            <select name="kabupaten_kota" required id="selectKota"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 @error('kabupaten_kota') border-red-500 @enderror">
                                                <option value="">-- Pilih Kota --</option>
                                            </select>
                                            @error('kabupaten_kota')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 4: Upload Dokumen -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-orange-500">
                                    <i class="fas fa-file-upload mr-2 text-orange-600"></i>Upload Dokumen
                                </h3>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil
                                                <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input name="foto" type="file"
                                                    accept="image/jpeg,image/jpg,image/png" required class="hidden"
                                                    id="inputFoto" />
                                                <label for="inputFoto"
                                                    class="block px-4 py-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-purple-500 cursor-pointer transition text-center bg-gray-50 hover:bg-purple-50">
                                                    <i class="fas fa-camera text-2xl text-gray-400 mb-2"></i>
                                                    <p class="text-sm font-medium text-gray-700">Klik untuk upload</p>
                                                    <p class="text-xs text-gray-500">JPG, PNG (max 2MB)</p>
                                                </label>
                                                <p class="text-xs text-gray-600 mt-1" id="fotoName">Belum ada file
                                                </p>
                                            </div>
                                            @error('foto')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto KTP <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input name="foto_ktp" type="file"
                                                    accept="image/jpeg,image/jpg,image/png" required class="hidden"
                                                    id="inputFotoKtp" />
                                                <label for="inputFotoKtp"
                                                    class="block px-4 py-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-purple-500 cursor-pointer transition text-center bg-gray-50 hover:bg-purple-50">
                                                    <i class="fas fa-id-card text-2xl text-gray-400 mb-2"></i>
                                                    <p class="text-sm font-medium text-gray-700">Klik untuk upload</p>
                                                    <p class="text-xs text-gray-500">JPG, PNG (max 2MB)</p>
                                                </label>
                                                <p class="text-xs text-gray-600 mt-1" id="ktpName">Belum ada file
                                                </p>
                                            </div>
                                            @error('foto_ktp')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 5: Keamanan -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-red-500">
                                    <i class="fas fa-lock mr-2 text-red-600"></i>Keamanan Akun
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Password <span
                                                class="text-red-500">*</span></label>
                                        <input name="password" type="password" required
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                                            placeholder="Masukkan password" />
                                        <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter, kombinasikan huruf
                                            dan angka</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password
                                            <span class="text-red-500">*</span></label>
                                        <input name="password_confirmation" type="password" required
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                                            placeholder="Konfirmasi password" />
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <input id="terms" name="terms" type="checkbox" required value="1"
                                    {{ old('terms') ? 'checked' : '' }}
                                    class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 cursor-pointer" />
                                <label for="terms" class="text-sm text-gray-700">
                                    Saya setuju dengan <a href="javascript:void(0);"
                                        class="text-blue-600 hover:underline font-semibold">syarat dan ketentuan</a>
                                    serta <a href="javascript:void(0);"
                                        class="text-blue-600 hover:underline font-semibold">kebijakan privasi</a>
                                    TOEKOE
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" id="submitBtn"
                                    class="w-full py-3 px-4 text-base font-semibold rounded-lg text-white bg-gradient-to-r from-purple-600 to-blue-600 hover:shadow-lg transform hover:scale-105 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span id="btnText">Daftar Sebagai Penjual</span>
                                    <span id="btnLoading" class="hidden">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
                                    </span>
                                </button>
                            </div>

                            <!-- Login Link -->
                            <p class="text-center text-gray-600 text-sm">
                                Sudah punya akun? <a href="/login"
                                    class="text-purple-600 hover:underline font-semibold">Login di sini</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        // Provinsi dan Kota dari config
        const locationsData = @json(config('locations'));

        // Dynamic kota selection
        document.getElementById('selectProvinsi').addEventListener('change', function() {
            const provinsi = this.value;
            const kotaSelect = document.getElementById('selectKota');

            kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';

            if (provinsi && locationsData[provinsi]) {
                locationsData[provinsi].forEach(kota => {
                    const option = document.createElement('option');
                    option.value = kota;
                    option.textContent = kota;
                    if ('{{ old('kabupaten_kota') }}' === kota) {
                        option.selected = true;
                    }
                    kotaSelect.appendChild(option);
                });
            }
        });

        // Initialize kota if provinsi already selected
        const selectedProvinsi = '{{ old('provinsi') }}';
        if (selectedProvinsi) {
            document.getElementById('selectProvinsi').dispatchEvent(new Event('change'));
        }

        // File upload handling
        const maxSize = 2 * 1024 * 1024; // 2MB

        document.getElementById('inputFoto').addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    this.value = '';
                    document.getElementById('fotoName').textContent = 'Belum ada file';
                } else {
                    document.getElementById('fotoName').textContent = file.name;
                }
            }
        });

        document.getElementById('inputFotoKtp').addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    this.value = '';
                    document.getElementById('ktpName').textContent = 'Belum ada file';
                } else {
                    document.getElementById('ktpName').textContent = file.name;
                }
            }
        });

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        });
    </script>
</body>

</html>
