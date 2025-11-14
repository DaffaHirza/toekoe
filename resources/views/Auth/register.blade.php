<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi Penjual</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="min-h-screen">
    <div class="main-content">
        <div class="bg-gray-50">
            <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
                <div class="max-w-4xl w-full">
                    <a href="/"><img src="{{ asset('build/assets/images/toekoe.png') }}" alt="logo"
                            class="w-40 mb-8 mx-auto block" />
                    </a>

                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <h1 class="text-slate-900 text-center text-3xl font-semibold">Registrasi Penjual</h1>
                        <p class="text-slate-600 text-sm text-center mt-2 mb-8">Lengkapi data toko Anda untuk mendaftar
                        </p>

                        <!-- Laravel Error Messages -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-semibold text-red-800 mb-2">Terdapat kesalahan pada
                                            form:</h3>
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
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6" id="registrationForm">
                            @csrf

                            <!-- Row 1: Nama Toko & Deskripsi Singkat -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Nama Toko <span
                                            class="text-red-500">*</span></label>
                                    <input name="nama_toko" type="text" required value="{{ old('nama_toko') }}"
                                        class="w-full text-slate-900 text-sm border @error('nama_toko') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Masukkan nama toko" />
                                    @error('nama_toko')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Deskripsi Singkat <span
                                            class="text-red-500">*</span></label>
                                    <input name="deskripsi_singkat" type="text" required
                                        value="{{ old('deskripsi_singkat') }}"
                                        class="w-full text-slate-900 text-sm border @error('deskripsi') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Deskripsi toko Anda" />

                                </div>
                            </div>

                            <!-- Row 2: Nama PIC & No Handphone PIC -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Nama PIC <span
                                            class="text-red-500">*</span></label>
                                    <input name="nama" type="text" required value="{{ old('nama') }}"
                                        class="w-full text-slate-900 text-sm border @error('nama_pic') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Nama penanggung jawab" />

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">No Handphone PIC <span
                                            class="text-red-500">*</span></label>
                                    <input name="no_hp" type="tel" required value="{{ old('no_hp') }}"
                                        class="w-full text-slate-900 text-sm border @error('no_hp_pic') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="08xxxxxxxxxx" />

                                </div>
                            </div>

                            <!-- Row 3: Email PIC & Alamat PIC -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Email PIC <span
                                            class="text-red-500">*</span></label>
                                    <input name="email" type="email" required value="{{ old('email') }}"
                                        class="w-full text-slate-900 text-sm border @error('email_pic') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="email@example.com" />

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Alamat (nama jalan) PIC
                                        <span class="text-red-500">*</span></label>
                                    <input name="alamat" type="text" required value="{{ old('alamat') }}"
                                        class="w-full text-slate-900 text-sm border @error('alamat_pic') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Nama jalan" />

                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">RT <span
                                            class="text-red-500">*</span></label>
                                    <input name="rt" type="text" required value="{{ old('rt') }}"
                                        class="w-full text-slate-900 text-sm border @error('rt') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="001" />

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">RW <span
                                            class="text-red-500">*</span></label>
                                    <input name="rw" type="text" required value="{{ old('rw') }}"
                                        class="w-full text-slate-900 text-sm border @error('rw') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="001" />

                                </div>
                            </div>

                            <!-- Row 5: Nama Kelurahan & Kabupaten/Kota -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Nama Kelurahan <span
                                            class="text-red-500">*</span></label>
                                    <input name="nama_kelurahan" type="text" required
                                        value="{{ old('nama_kelurahan') }}"
                                        class="w-full text-slate-900 text-sm border @error('kelurahan') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Nama kelurahan" />

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Kabupaten/Kota <span
                                            class="text-red-500">*</span></label>
                                    <input name="kabupaten_kota" type="text" required
                                        value="{{ old('kabupaten_kota') }}"
                                        class="w-full text-slate-900 text-sm border @error('kabupaten_kota') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Nama kabupaten/kota" />

                                </div>
                            </div>

                            <!-- Row 6: provinsi & No. KTP PIC -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Provinsi <span
                                            class="text-red-500">*</span></label>
                                    <input name="provinsi" type="text" required value="{{ old('provinsi') }}"
                                        class="w-full text-slate-900 text-sm border @error('provinsi') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="Nama provinsi" />

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">No. KTP PIC <span
                                            class="text-red-500">*</span></label>
                                    <input name="no_ktp" type="text" required value="{{ old('no_ktp') }}"
                                        class="w-full text-slate-900 text-sm border @error('no_ktp') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600"
                                        placeholder="16 digit nomor KTP" maxlength="16" />

                                </div>
                            </div>

                            <!-- Row 7: Foto PIC & File Upload KTP PIC -->
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Foto PIC <span
                                            class="text-red-500">*</span></label>
                                    <input name="foto" type="file" accept="image/jpeg,image/jpg,image/png"
                                        required
                                        class="w-full text-slate-900 text-sm border @error('foto_pic') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG. Max 2MB</p>

                                </div>
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">File Upload KTP PIC
                                        <span class="text-red-500">*</span></label>
                                    <input name="foto_ktp" type="file" accept="image/jpeg,image/jpg,image/png"
                                        required
                                        class="w-full text-slate-900 text-sm border @error('file_ktp') border-red-500 @else border-slate-300 @enderror px-4 py-3 rounded-md outline-blue-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG. Max 2MB</p>

                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                                    <div class="relative flex items-center">
                                        <input name="password" type="password" required
                                            class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-blue-600"
                                            placeholder="Enter password" />
                                    </div>

                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-6 mt-2">
                                <div class="flex-1">
                                    <label class="text-slate-900 text-sm font-medium mb-2 block">Konfirmasi
                                        Password</label>
                                    <div class="relative flex items-center">
                                        <input name="password_confirmation" type="password" required
                                            class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-blue-600"
                                            placeholder="Confirm password" />
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="@error('terms') border border-red-500 rounded-md p-3 @enderror">
                                <div class="flex items-start">
                                    <input id="terms" name="terms" type="checkbox" required value="1"
                                        {{ old('terms') ? 'checked' : '' }}
                                        class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded mt-1" />
                                    <label for="terms" class="ml-3 block text-sm text-slate-900">
                                        Saya menyetujui <a href="javascript:void(0);"
                                            class="text-blue-600 hover:underline font-semibold">syarat dan
                                            ketentuan</a> yang berlaku
                                    </label>
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="!mt-8">
                                <button type="submit" id="submitBtn"
                                    class="w-full py-3 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none cursor-pointer transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    <span id="btnText">Daftar Sekarang</span>
                                    <span id="btnLoading" class="hidden">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
                                    </span>
                                </button>
                            </div>

                            <!-- Login Link -->
                            <p class="text-slate-900 text-sm !mt-6 text-center">
                                Sudah punya akun?
                                <a href="/login"
                                    class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">
                                    Login di sini
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        // Simple client-side validation for better UX (NOT security)
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            // Show loading state
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        });

        // File size validation (UX only)
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar! Maksimal 2MB');
                        this.value = '';
                    }
                }
            });
        });
    </script>
</body>

</html>
