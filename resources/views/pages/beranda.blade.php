@extends('layouts.app')

<style>
    .bg-gradient-radial {
        background: radial-gradient(circle, var(--tw-gradient-stops));
    }
</style>

@section('title', 'Beranda')

@section('content')
    <div class="min-h-screen px-4 flex justify-center py-10">
        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div
                class="rounded-3xl px-7 mb-10 relative overflow-hidden shadow-md bg-gradient-to-br from-blue-400 to-blue-700">
                <div class="flex flex-col my-5 md:flex-row items-center gap-8 min-h-[400px]">
                    <div class="absolute inset-0 ">
                        <div
                            class="absolute top-0 left-0 w-[50%] h-100 bg-gradient-radial from-white/30 via-white/10 to-transparent rounded-full blur-2xl transform -translate-x-60 -translate-y-40">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-[50%] h-100 bg-gradient-radial from-white/30 via-white/10 to-transparent rounded-full blur-2xl transform -translate-x-10 -translate-y-40">
                        </div>

                        <div class="absolute bottom-12 right-0 w-96 h-96 opacity-60">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-purple-300 via-blue-300 to-green-300 rounded-full blur-xl transform translate-x-32 translate-y-32">
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 text-white z-10">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang Di TOEKOE</h1>
                        <p class="text-lg md:text-xl text-white/90 mb-6">
                            Jelajahi koleksi Masterpiece Pilihan kami, di mana setiap item dipilih berdasarkan nilai
                            keunikan dan keunggulan.
                        </p>
                        <a href="{{ route('produk.filter') }}"
                            class="bg-white text-blue-500 px-8 py-3 rounded-full font-semibold hover:bg-white/90 transition-all duration-300 shadow-lg">
                            Jelajahi Sekarang
                        </a>
                    </div>

                    <img src="{{ asset('build/assets/images/vektor1.svg') }}" alt="Hero Image"
                        class="w-[100%] max-w-lg object-contain" />
                </div>
            </div>
            <div class="max-w-7xl mx-auto w-full relative z-10">
                <div class="rounded-xl border border-blue-500 px-7 mb-4 relative overflow-hidden ">
                    @if (!empty($categories) && $categories->count() > 0)
                        <div class="rounded-3xl relative overflow-hidden">
                            <div class="flex flex-col my-5 md:flex-row items-center gap-8">
                                <div class="flex-1 text-black">
                                    <p class="text-4xl font-bold">Kategori Pilihan</p>
                                </div>
                                <a href="{{ route('produk.filter') }}"
                                    class="bg-blue-500 text-white px-8 py-3 border-blue-500 border-2 rounded-xl font-semibold hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-all duration-300">
                                    Jelajahi Sekarang
                                </a>
                            </div>
                            <div class="flex gap-3 overflow-x-auto pb-5" id="category-buttons">
                                <!-- Tombol Semua -->
                                <button data-category="all"
                                    class="category-btn flex-shrink-0 rounded-xl border-2 px-6 py-3 text-center transition-all duration-300 cursor-pointer
                                    {{ !request('category') || request('category') == 'all' ? 'bg-blue-500 text-white border-blue-500 shadow-lg active' : 'bg-white text-slate-900 border-blue-500 hover:bg-blue-50 hover:text-slate-900' }}">
                                    <p class="text-md font-semibold whitespace-nowrap">Semua Produk</p>
                                </button>

                                @forelse($categories as $cat)
                                    <button data-category="{{ $cat->id }}"
                                        class="category-btn flex-shrink-0 rounded-xl border-2 px-6 py-3 text-center transition-all duration-300 cursor-pointer
                                        {{ request('category') == $cat->id ? 'bg-blue-500 text-white border-blue-500 shadow-lg active ' : 'bg-white text-slate-900 border-blue-500 hover:bg-blue-50 hover:text-slate-900' }}">
                                        <p class="text-md font-semibold whitespace-nowrap">{{ $cat->nama }}</p>
                                    </button>
                                @empty
                                    <div class="col-span-full text-center py-8">
                                        <p class="text-gray-500 text-lg">Belum ada kategori</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>

                <div class="pt-4 mb-4 flex justify-between items-center max-w-7xl mx-auto">
                    <div>
                        <h2 id="category-title" class="text-2xl font-bold text-slate-900">
                            @if (request('category') && request('category') != 'all')
                                @php
                                    $selectedCategory = $categories->firstWhere('id', request('category'));
                                @endphp
                                Produk {{ $selectedCategory ? $selectedCategory->nama : 'Kategori' }}
                            @else
                                Semua Produk
                            @endif
                        </h2>
                        <p id="product-count" class="text-sm text-slate-500 mt-1">Menampilkan {{ $products->count() }}
                            produk</p>
                    </div>
                </div>

                <div class="pt-4 flex justify-between max-w-7xl mx-auto">
                    <div id="products-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @forelse($products as $product)
                            <a href="{{ route('produk.detail', $product->id) }}"
                                class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all hover:shadow-xl">
                                <div class="w-full bg-gray-50">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama_produk }}"
                                        class="w-full object-cover object-center aspect-square" />
                                </div>
                                <div class="p-2 mb-2 flex-1 flex flex-col">
                                    <div class="flex-1">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">
                                            {{ $product->nama_produk }}</h5>
                                        <p class="text-xs text-slate-500 mt-1">{{ $product->user->nama_toko }}</p>
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-2 mt-2 text-sm text-gray-600">
                                                @php
                                                    $avg = $product->reviews->count()
                                                        ? number_format($product->reviews->avg('rating'), 1)
                                                        : '0.0';
                                                    $count = $product->reviews->count();
                                                @endphp
                                                <div class="flex items-center gap-1">
                                                    <span class="text-yellow-400 font-semibold">{{ $avg }}</span>
                                                    <div class="flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <svg class="w-4 h-4 {{ $i <= round($product->reviews->avg('rating') ?? 0) ? 'fill-yellow-400' : 'fill-gray-300' }}"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span class="text-xs text-gray-500">({{ $count }})</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap justify-between gap-2 mt-2">
                                            <div class="flex gap-2 items-center">
                                                <h6 class="text-xl font-bold text-blue-600">Rp
                                                    {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span
                                                    class="text-xs px-2 py-1 rounded-md {{ $product->kondisi == 'baru' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                    {{ ucfirst($product->kondisi) }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-sm">
                                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <p class="text-gray-500 text-lg font-semibold mb-2">
                                    @if (request('category') && request('category') != 'all')
                                        Belum ada produk dalam kategori ini
                                    @else
                                        Belum ada produk yang tersedia
                                    @endif
                                </p>
                                <p class="text-gray-400 text-sm">Silakan coba kategori lain atau kembali lagi nanti</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.category-btn');
            const productsGrid = document.getElementById('products-grid');
            const categoryTitle = document.getElementById('category-title');
            const productCount = document.getElementById('product-count');

            // Load initial products
            loadProducts('{{ request('category') ?? 'all' }}');

            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');

                    // Update active state
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('bg-blue-500', 'text-white', 'shadow-lg',
                            'active');
                        btn.classList.add('bg-white', 'text-slate-900');
                    });

                    this.classList.remove('bg-white', 'text-slate-900');
                    this.classList.add('bg-blue-500', 'text-white', 'shadow-lg', 'active');

                    // Load products via AJAX
                    loadProducts(category);

                    // Update URL without reload
                    const url = new URL(window.location);
                    if (category === 'all') {
                        url.searchParams.delete('category');
                    } else {
                        url.searchParams.set('category', category);
                    }
                    window.history.pushState({}, '', url);
                });
            });

            function loadProducts(category) {
                // Show loading state
                productsGrid.innerHTML = `
                    <div class="col-span-full flex justify-center items-center py-20">
                        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-500"></div>
                    </div>
                `;

                // Fetch products
                fetch(`{{ route('home') }}?category=${category}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update title and count
                        categoryTitle.textContent = category === 'all' ? 'Semua Produk' :
                            `Produk ${data.category_name}`;
                        productCount.textContent = `Menampilkan ${data.count} produk`;

                        // Render products
                        if (data.products.length > 0) {
                            productsGrid.innerHTML = data.products.map(product => renderProduct(product)).join(
                                '');
                        } else {
                            productsGrid.innerHTML = renderEmptyState(category !== 'all');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        productsGrid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <p class="text-red-500">Terjadi kesalahan saat memuat produk</p>
                        </div>
                    `;
                    });
            }

            function renderProduct(product) {
                const avgRating = product.reviews.length > 0 ?
                    (product.reviews.reduce((sum, r) => sum + r.rating, 0) / product.reviews.length).toFixed(1) :
                    '0.0';
                const reviewCount = product.reviews.length;
                const roundedRating = Math.round(avgRating);

                const stars = Array.from({
                    length: 5
                }, (_, i) => {
                    const filled = i < roundedRating;
                    return `<svg class="w-4 h-4 ${filled ? 'fill-yellow-400' : 'fill-gray-300'}" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>`;
                }).join('');

                const kondisiClass = product.kondisi === 'baru' ? 'bg-green-100 text-green-700' :
                    'bg-yellow-100 text-yellow-700';

                return `
                    <a href="/produk/${product.id}" class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all hover:shadow-xl">
                        <div class="w-full bg-gray-50">
                            <img src="/storage/${product.image}" alt="${product.nama_produk}" class="w-full object-cover object-center aspect-square" />
                        </div>
                        <div class="p-2 mb-2 flex-1 flex flex-col">
                            <div class="flex-1">
                                <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">${product.nama_produk}</h5>
                                <p class="text-xs text-slate-500 mt-1">${product.user.nama_toko}</p>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-2 mt-2 text-sm text-gray-600">
                                        <div class="flex items-center gap-1">
                                            <span class="text-yellow-400 font-semibold">${avgRating}</span>
                                            <div class="flex">${stars}</div>
                                        </div>
                                        <span class="text-xs text-gray-500">(${reviewCount})</span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap justify-between gap-2 mt-2">
                                    <div class="flex gap-2 items-center">
                                        <h6 class="text-xl font-bold text-blue-600">Rp ${new Intl.NumberFormat('id-ID').format(product.harga)}</h6>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="text-xs px-2 py-1 rounded-md ${kondisiClass}">${product.kondisi.charAt(0).toUpperCase() + product.kondisi.slice(1)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
            }

            function renderEmptyState(isFiltered) {
                return `
                    <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-sm">
                        <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-500 text-lg font-semibold mb-2">
                            ${isFiltered ? 'Belum ada produk dalam kategori ini' : 'Belum ada produk yang tersedia'}
                        </p>
                        <p class="text-gray-400 text-sm">Silakan coba kategori lain atau kembali lagi nanti</p>
                    </div>
                `;
            }
        });
    </script>
@endsection
