@extends('layouts.app')

@section('title', $product->nama_produk)

@section('content')
    <style>
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .modal-backdrop.show {
            display: flex;
        }
    </style>

    <div class="min-h-screen bg-gray-50 py-10 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid md:grid-cols-2 gap-8 p-8">
                    <!-- Product Image -->
                    <div class="space-y-4">
                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="flex flex-col">
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->nama_produk }}</h1>

                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="text-xs px-3 py-1 rounded-md {{ $product->kondisi == 'baru' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($product->kondisi) }}
                                </span>
                                <span class="text-sm text-gray-500">Kategori: {{ $product->Category->nama ?? '-' }}</span>
                            </div>

                            <div class="mb-6">
                                <p class="text-4xl font-bold text-blue-600">Rp
                                    {{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>

                            <div class="border-t border-b border-gray-200 py-4 mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-gray-600">Stok Tersedia:</span>
                                    <span class="font-semibold">{{ $product->stok }} unit</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Toko:</span>
                                    <span class="font-semibold text-blue-600">{{ $product->user->nama_toko }}</span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Deskripsi Produk</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->deskripsi }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h3 class="text-sm font-semibold mb-2">Informasi Penjual</h3>
                                <p class="text-sm text-gray-600"><strong>Nama:</strong> {{ $product->user->nama }}</p>
                                <p class="text-sm text-gray-600"><strong>No. HP:</strong> {{ $product->user->no_hp }}</p>
                                <p class="text-sm text-gray-600"><strong>Alamat:</strong> {{ $product->user->alamat }}, RT
                                    {{ $product->user->rt }}/RW {{ $product->user->rw }},
                                    {{ $product->user->nama_kelurahan }}, {{ $product->user->kabupaten_kota }},
                                    {{ $product->user->provinsi }}</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button
                                class="flex-1 bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 rounded-lg transition duration-300">
                                <i class="bi bi-heart"></i> Wishlist
                            </button>
                            <a href="{{ route('home') }}"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 rounded-lg transition duration-300">
                                ← Kembali ke Beranda

                            </a>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="mt-8 bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Rating & Review</h2>

                    <!-- Average Rating -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-blue-600">
                                    {{ $product->reviews->count() > 0 ? number_format($product->reviews->avg('rating'), 1) : '0.0' }}
                                </div>
                                <div class="flex justify-center mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= ($product->reviews->avg('rating') ?? 0) ? 'fill-yellow-400' : 'fill-gray-300' }}"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $product->reviews->count() }} Review</p>
                            </div>
                            <div class="flex-1">
                                @for ($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $product->reviews->where('rating', $i)->count();
                                        $percentage =
                                            $product->reviews->count() > 0
                                                ? ($count / $product->reviews->count()) * 100
                                                : 0;
                                    @endphp
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm w-8">{{ $i }} ⭐</span>
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div class="bg-yellow-400 h-2 rounded-full"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 w-12">{{ $count }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Add Review Form -->
                    <div class="border-t pt-6">
                        <h3 class="text-xl font-semibold mb-4">Tulis Review Anda</h3>

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('produk.review.store', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Nama <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">No. Handphone <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" required
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Provinsi <span
                                            class="text-red-500">*</span></label>
                                    <select name="provinsi" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Pilih provinsi</option>
                                        @if (!empty($provinsi_list) && is_array($provinsi_list))
                                            @foreach ($provinsi_list as $prov)
                                                <option value="{{ $prov }}"
                                                    {{ old('provinsi') == $prov ? 'selected' : '' }}>{{ $prov }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>



                            <div>
                                <label class="block text-sm font-medium mb-2">Rating <span
                                        class="text-red-500">*</span></label>
                                <div class="flex gap-2" x-data="{ rating: {{ old('rating', 0) }} }">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" @click="rating = {{ $i }}"
                                            class="text-3xl focus:outline-none">
                                            <span x-show="rating >= {{ $i }}" class="text-yellow-400">★</span>
                                            <span x-show="rating < {{ $i }}" class="text-gray-300">★</span>
                                        </button>
                                    @endfor
                                    <input type="hidden" name="rating" x-model="rating" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Komentar <span
                                        class="text-red-500">*</span></label>
                                <textarea name="komentar" rows="4" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('komentar') }}</textarea>
                            </div>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                                Kirim Review
                            </button>
                        </form>
                    </div>

                    <!-- Reviews List -->
                    <div class="border-t mt-8 pt-6">
                        <h3 class="text-xl font-semibold mb-4">Semua Review ({{ $product->reviews->count() }})</h3>

                        @forelse($product->reviews->sortByDesc('created_at') as $review)
                            <div class="border-b last:border-b-0 pb-4 mb-4">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            {{ strtoupper(substr($review->nama_pengunjung, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="font-semibold">{{ $review->nama_pengunjung }}</h4>
                                            <span
                                                class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-yellow-400' : 'fill-gray-300' }}"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-700 mb-2">{{ $review->komentar }}</p>
                                        <div class="text-sm text-gray-600 space-y-1">
                                            @if (!empty($review->email))
                                                <p><strong>Email:</strong> {{ $review->email }}</p>
                                            @endif
                                            @if (!empty($review->nomor_hp))
                                                <p><strong>No. HP:</strong> {{ $review->nomor_hp }}</p>
                                            @endif
                                            @if (!empty($review->provinsi))
                                                <p><strong>Provinsi:</strong> {{ $review->provinsi }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">Belum ada review untuk produk ini</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal-backdrop">
        <div class="bg-white rounded-lg shadow-2xl p-8 max-w-md w-full mx-4 text-center transform transition">
            <div class="mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Terima Kasih!</h2>
            <p class="text-gray-600 mb-6">Terima kasih sudah memberikan rating dan review. Masukan Anda sangat berharga
                untuk kami!</p>
            <div class="space-y-3">
                <button id="closeModalBtn"
                    class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    Kembali ke Produk
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Show success modal if there's a success message
        @if (session('success'))
            window.addEventListener('load', function() {
                document.getElementById('successModal').classList.add('show');
            });
        @endif

        // Close modal button
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('successModal').classList.remove('show');
            // Scroll ke review list
            document.querySelector('.border-t.mt-8').scrollIntoView({
                behavior: 'smooth'
            });
        });

        // Close modal on backdrop click
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                document.getElementById('successModal').classList.remove('show');
            }
        });
    </script>
@endsection
