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
                class="rounded-3xl px-7 mb-10 relative overflow-hidden shadow-2xl bg-gradient-to-br from-blue-400 to-blue-700">
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
                        <button
                            class="bg-white text-blue-500 px-8 py-3 rounded-full font-semibold hover:bg-white/90 transition-all duration-300 shadow-lg">
                            Jelajahi Sekarang
                        </button>
                    </div>

                    <img src="{{ asset('build/assets/images/vektor1.svg') }}" alt="Hero Image"
                        class="w-[100%] max-w-lg object-contain" />
                </div>
            </div>
            <div class="max-w-7xl mx-auto w-full relative z-10">
                <div class="rounded-3xl relative overflow-hidden">
                    <div class="flex flex-col my-5 md:flex-row items-center gap-8">
                        <div class="flex-1 text-black">
                            <p class="text-4xl font-bold">Explore popular product</p>
                        </div>
                        <a href="/"
                            class="bg-blue-500 text-white px-8 py-3 border-blue-500 border-2 rounded-2xl font-semibold hover:bg-white hover:text-blue-500 hover:border-blue-500 shadow-lg">
                            Jelajahi Sekarang
                        </a>
                    </div>
                </div>
                <div class="h-[3px] bg-blue-500 w-full"></div>
                <div class="pt-4 flex justify-between max-w-7xl mx-auto">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                        @forelse($products as $product)
                        <a href="{{ route('produk.detail', $product->id) }}" class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all hover:shadow-xl">
                            <div class="w-full bg-gray-50">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama_produk }}"
                                    class="w-full object-cover object-center aspect-square" />
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">{{ $product->nama_produk }}</h5>
                                    <p class="text-xs text-slate-500 mt-1">{{ $product->user->nama_toko }}</p>
                                    <p class="text-sm mt-1 text-slate-600 line-clamp-2">{{ Str::limit($product->deskripsi, 60) }}</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2 items-center">
                                            <h6 class="text-sm sm:text-base font-bold text-blue-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="text-xs px-2 py-1 rounded-full {{ $product->kondisi == 'baru' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                {{ ucfirst($product->kondisi) }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">Stok: {{ $product->stok }}</p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">Belum ada produk yang tersedia</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
