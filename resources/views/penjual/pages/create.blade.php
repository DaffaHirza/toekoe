@extends('penjual.layouts.master')

@section('title', 'Tambah Data Produk')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div x-data="{
        gambarPreview: null,
        hargaInput: '',
        kondisi: 'baru'
    }" class="w-full bg-white dark:bg-slate-800 shadow-xl rounded-3xl p-8 space-y-6">

        <h2 class="text-5xl font-extrabold text-center text-slate-800  mb-6 tracking-wide drop-shadow-xl">
            Upload Produk Baru
        </h2>

        <form action="{{ route('penjual.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- NAMA PRODUK --}}
            <div>
                <label class="block text-sm font-semibold mb-1 ">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                    class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50"
                    placeholder="Contoh: Laptop ASUS ROG" required>
                @error('nama_produk')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block text-sm font-semibold mb-1 ">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50"
                    placeholder="Jelaskan produk secara detail..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- KATEGORI --}}
            <div>
                <label class="block text-sm font-semibold mb-1 ">Kategori Produk <span class="text-red-500">*</span></label>
                <select name="category_id" class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONDISI PRODUK --}}
            <div>
                <label class="block text-sm font-semibold mb-1 ">Kondisi Produk <span class="text-red-500">*</span></label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="kondisi" value="baru" x-model="kondisi"
                            {{ old('kondisi', 'baru') == 'baru' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600">
                        <span class="text-sm ">🆕 Baru</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="kondisi" value="bekas" x-model="kondisi"
                            {{ old('kondisi') == 'bekas' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600">
                        <span class="text-sm ">📦 Bekas</span>
                    </label>
                </div>
                @error('kondisi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- HARGA & STOK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1 ">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input x-model="hargaInput" type="number" name="harga" value="{{ old('harga') }}"
                        class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50"
                        placeholder="Contoh: 5000000" min="0" required>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 ">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stok" value="{{ old('stok') }}"
                        class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50"
                        placeholder="Contoh: 10" min="0" required>
                    @error('stok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- PREVIEW HARGA --}}
            <div class="bg-indigo-50  px-4 py-3 rounded-xl">
                <p class="text-sm text-slate-600 ">
                    Preview Harga:
                    <span class="font-bold text-indigo-600 dark:text-indigo-300"
                        x-text="hargaInput ? 'Rp ' + parseFloat(hargaInput).toLocaleString('id-ID') : 'Rp 0'"></span>
                </p>
            </div>

            {{-- GAMBAR PRODUK --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold ">Gambar Produk</label>
                <input type="file" name="image" accept="image/*"
                    @change="gambarPreview = URL.createObjectURL($event.target.files[0])"
                    class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50">
                <p class="text-xs text-slate-500">Format: JPG, PNG, GIF (Max: 2MB)</p>

                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <template x-if="gambarPreview">
                    <div class="mt-3">
                        <p class="text-xs text-slate-500 mb-2">Preview:</p>
                        <img :src="gambarPreview"
                            class="w-48 h-48 object-cover rounded-xl shadow-md border-2 border-indigo-200">
                    </div>
                </template>
            </div>

            {{-- SUBMIT BUTTONS --}}
            <div class="pt-4 flex gap-3">
                <button type="submit"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl py-3 transition">
                    🚀 Upload Produk Sekarang
                </button>
                <a href="{{ route('penjual.pages.view') }}"
                    class="px-6 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl py-3 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
