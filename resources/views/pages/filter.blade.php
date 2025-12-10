@extends('layouts.app')

@section('title', 'Filter & Cari Produk')

@section('content')
    <div>
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Filter -->
            <div
                class="bg-gray-50 w-full lg:max-w-[280px] border border-gray-100 shrink-0 px-6 my-6 ml-6 rounded-xl sm:px-8 py-6 lg:border-r">
                <div class="flex items-center border-b border-gray-300 pb-2 mb-6">
                    <h3 class="text-slate-900 text-lg font-semibold">Filter</h3>
                    <a href="{{ route('produk.filter') }}"
                        class="text-sm text-red-500 font-semibold ml-auto cursor-pointer hover:text-red-700">Clear all</a>
                </div>

                <form action="{{ route('produk.filter') }}" method="GET" id="filterForm" class="space-y-6">
                    <!-- Search Input -->
                    <div>
                        <label class="block text-slate-900 text-base font-semibold mb-2">Cari Produk/Toko</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama produk, toko..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>

                    <!-- Filter Harga -->
                    <div>
                        <label class="block text-slate-900 text-base font-semibold mb-2">Rentang Harga (Rp)</label>
                        <div class="flex gap-2">
                            <input type="number" name="harga_min" value="{{ request('harga_min') }}" placeholder="Min"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <input type="number" name="harga_max" value="{{ request('harga_max') }}" placeholder="Max"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <!-- Filter Kategori -->
                    <div>
                        <div class="header flex items-center gap-2 justify-between cursor-pointer">
                            <h4 class="text-slate-900 text-base font-semibold">Kategori</h4>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="arrow w-[14px] h-[14px] fill-slate-800 transition-all duration-300 -rotate-90"
                                viewBox="0 0 492.004 492.004">
                                <path
                                    d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"
                                    data-original="#000000" />
                            </svg>
                        </div>
                        <div class="collape-content overflow-hidden transition-all duration-300">
                            <ul class="mt-4 px-2 space-y-3">
                                <li class="flex items-center gap-3">
                                    <input id="cat-all" type="radio" name="category" value=""
                                        {{ !request('category') ? 'checked' : '' }} class="w-4 h-4 cursor-pointer" />
                                    <label for="cat-all" class="text-slate-600 font-medium text-sm cursor-pointer">Semua
                                        Kategori</label>
                                </li>
                                @forelse($categories as $cat)
                                    <li class="flex items-center gap-3">
                                        <input id="cat-{{ $cat->id }}" type="radio" name="category"
                                            value="{{ $cat->id }}"
                                            {{ request('category') == $cat->id ? 'checked' : '' }}
                                            class="w-4 h-4 cursor-pointer" />
                                        <label for="cat-{{ $cat->id }}"
                                            class="text-slate-600 font-medium text-sm cursor-pointer">{{ $cat->nama }}</label>
                                    </li>
                                @empty
                                    <li class="text-slate-400 text-sm">Tidak ada kategori</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Filter Kondisi -->
                    <div>
                        <div class="header flex items-center gap-2 justify-between cursor-pointer">
                            <h4 class="text-slate-900 text-base font-semibold">Kondisi</h4>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="arrow w-[14px] h-[14px] fill-slate-800 transition-all duration-300 rotate-90"
                                viewBox="0 0 492.004 492.004">
                                <path
                                    d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"
                                    data-original="#000000" />
                            </svg>
                        </div>
                        <div class="collape-content h-0 overflow-hidden transition-all duration-300">
                            <div class="mt-4 space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="kondisi" value=""
                                        {{ !request('kondisi') ? 'checked' : '' }} class="w-4 h-4">
                                    <span class="text-slate-600 text-sm">Semua</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="kondisi" value="baru"
                                        {{ request('kondisi') === 'baru' ? 'checked' : '' }} class="w-4 h-4">
                                    <span class="text-slate-600 text-sm">Baru</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="kondisi" value="bekas"
                                        {{ request('kondisi') === 'bekas' ? 'checked' : '' }} class="w-4 h-4">
                                    <span class="text-slate-600 text-sm">Bekas</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Provinsi Toko -->
                    <div>
                        <div class="header flex items-center gap-2 justify-between cursor-pointer">
                            <h4 class="text-slate-900 text-base font-semibold">Provinsi Toko</h4>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="arrow w-[14px] h-[14px] fill-slate-800 transition-all duration-300 rotate-90"
                                viewBox="0 0 492.004 492.004">
                                <path
                                    d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"
                                    data-original="#000000" />
                            </svg>
                        </div>
                        <div class="collape-content h-0 overflow-hidden transition-all duration-300">
                            <select name="provinsi"
                                class="w-full mt-4 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="">Semua Provinsi</option>
                                @forelse($provinces as $prov)
                                    <option value="{{ $prov }}"
                                        {{ request('provinsi') === $prov ? 'selected' : '' }}>{{ $prov }}</option>
                                @empty
                                    <option disabled>Tidak ada data provinsi</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <!-- Filter Kabupaten/Kota -->
                    <div>
                        <div class="header flex items-center gap-2 justify-between cursor-pointer">
                            <h4 class="text-slate-900 text-base font-semibold">Kabupaten/Kota</h4>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="arrow w-[14px] h-[14px] fill-slate-800 transition-all duration-300 rotate-90"
                                viewBox="0 0 492.004 492.004">
                                <path
                                    d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z"
                                    data-original="#000000" />
                            </svg>
                        </div>
                        <div class="collape-content h-0 overflow-hidden transition-all duration-300">
                            <select name="kabupaten_kota"
                                class="w-full mt-4 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="">Semua Kabupaten/Kota</option>
                                @forelse($cities as $city)
                                    <option value="{{ $city }}"
                                        {{ request('kabupaten_kota') === $city ? 'selected' : '' }}>{{ $city }}
                                    </option>
                                @empty
                                    <option disabled>Tidak ada data kota</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <!-- Filter Nama Toko -->
                    <div>
                        <label class="block text-slate-900 text-base font-semibold mb-2">Nama Toko</label>
                        <input type="text" name="nama_toko" value="{{ request('nama_toko') }}"
                            placeholder="Cari nama toko..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-slate-900 text-base font-semibold mb-2">Urutkan</label>
                        <select name="sort"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">Terbaru</option>
                            <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Rating Tertinggi
                            </option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition text-sm">
                            🔍 Filter
                        </button>
                        <a href="{{ route('produk.filter') }}"
                            class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 rounded-lg transition text-center text-sm">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Main Content -->
            <div class="w-full py-6 px-4 sm:px-8">
                <!-- Results Info -->
                @if (request()->filled('search') ||
                        request()->filled('category') ||
                        request()->filled('harga_min') ||
                        request()->filled('harga_max') ||
                        request()->filled('kondisi') ||
                        request()->filled('provinsi') ||
                        request()->filled('kabupaten_kota') ||
                        request()->filled('nama_toko'))
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-slate-700 text-sm">
                            <span class="font-semibold">Hasil pencarian:</span>
                            @if (request('search'))
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">"{{ request('search') }}"</span>
                            @endif
                            @if (request('category'))
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">Kategori:
                                    {{ $categories->where('id', request('category'))->first()?->nama ?? 'N/A' }}</span>
                            @endif
                            @if (request('provinsi'))
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">Provinsi:
                                    {{ request('provinsi') }}</span>
                            @endif
                            @if (request('kabupaten_kota'))
                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mr-2">Kota:
                                    {{ request('kabupaten_kota') }}</span>
                            @endif
                            — Ditemukan <strong>{{ $products->count() }}</strong> produk
                        </p>
                    </div>
                @endif

                <!-- Product Grid -->
                @if ($products->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @foreach ($products as $product)
                            <a href="{{ route('produk.detail', $product->id) }}"
                                class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all hover:shadow-xl">
                                <div class="w-full bg-gray-50">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->nama_produk }}"
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
                        @endforeach
                    </div>
                @else
                    <!-- No Products Found -->
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-400 mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10a4 4 0 018 0m0 0a4 4 0 01-8 0m12-8a4 4 0 018 0m0 0a4 4 0 01-8 0" />
                        </svg>
                        <h3 class="text-slate-900 font-semibold text-lg mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-slate-600 text-sm mb-4">Coba ubah filter atau pencarian Anda</p>
                        <a href="{{ route('produk.filter') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            Lihat Semua Produk
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ===== Dropdown Toggle Functionality =====
        const headers = document.querySelectorAll('#filterForm .header');
        headers.forEach(header => {
            const content = header.parentElement.querySelector('.collape-content');
            const arrow = header.querySelector('.arrow');

            if (!content) return;

            // Initialize maxHeight based on whether it's collapsed (has h-0) or not
            if (content.classList.contains('h-0')) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }

            header.addEventListener('click', () => {
                if (content.style.maxHeight) {
                    // Collapse
                    content.style.maxHeight = null;
                    content.classList.add('h-0');
                } else {
                    // Expand
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.classList.remove('h-0');
                }

                if (arrow) {
                    arrow.classList.toggle('-rotate-90');
                    arrow.classList.toggle('rotate-90');
                }
            });
        });

        // ===== Dynamic Province-City Filtering =====
        const locationsData = @json(config('locations'));
        const provinsiSelect = document.querySelector('select[name="provinsi"]');
        const kabupatenSelect = document.querySelector('select[name="kabupaten_kota"]');

        function updateCityOptions(province) {
            kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten/Kota</option>';

            if (province && locationsData[province]) {
                const cities = locationsData[province];
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.text = city;
                    kabupatenSelect.appendChild(option);
                });
            } else {
                // Jika tidak ada provinsi dipilih, tampilkan semua kota
                const allCities = new Set();
                for (const province in locationsData) {
                    locationsData[province].forEach(city => {
                        allCities.add(city);
                    });
                }
                Array.from(allCities).sort().forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.text = city;
                    kabupatenSelect.appendChild(option);
                });
            }
        }

        if (provinsiSelect && kabupatenSelect) {
            provinsiSelect.addEventListener('change', function() {
                updateCityOptions(this.value);
            });
        }
    });
</script>
