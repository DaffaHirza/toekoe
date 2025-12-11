@extends('admin.layouts.master')

@section('title', 'Data Produk')

@section('content')
    <div class="p-6">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="font-bold text-2xl">Data Produk dari Semua Seller</h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50 whitespace-nowrap">
                    <tr>
                        <th class="pl-4 w-8">
                            <input id="checkbox" type="checkbox" class="hidden peer" />
                            <label for="checkbox"
                                class="relative flex items-center justify-center p-0.5 peer-checked:before:hidden before:block before:absolute before:w-full before:h-full before:bg-white w-5 h-5 cursor-pointer bg-blue-500 border border-gray-400 rounded overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                                    <path
                                        d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"
                                        data-name="7-Check" data-original="#000000" />
                                </svg>
                            </label>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Nama Produk
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Toko
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Kondisi
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Harga
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Kategori
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Stok
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Rating
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            Gambar
                        </th>
                    </tr>
                </thead>

                <tbody class="whitespace-nowrap divide-y divide-gray-200">
                    @forelse ($products as $product)
                        <tr>
                            <td class="pl-4 w-8">
                                <input id="checkbox-{{ $product->id }}" type="checkbox" class="hidden peer" />
                                <label for="checkbox-{{ $product->id }}"
                                    class="relative flex items-center justify-center p-0.5 peer-checked:before:hidden before:block before:absolute before:w-full before:h-full before:bg-white w-5 h-5 cursor-pointer bg-blue-500 border border-gray-400 rounded overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full fill-white" viewBox="0 0 520 520">
                                        <path
                                            d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"
                                            data-name="7-Check" data-original="#000000" />
                                    </svg>
                                </label>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-900 font-medium">
                                {{ $product->nama_produk }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                {{ $product->user->nama_toko ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                <span class="px-2 py-1 rounded-md text-xs {{ $product->kondisi == 'baru' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($product->kondisi) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                {{ $product->category->nama ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium text-center">
                                <span class="px-2 py-1 rounded-md text-xs {{ $product->stok > 10 ? 'bg-green-100 text-green-700' : ($product->stok > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $product->stok }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                <div class="flex items-center gap-1">
                                    <span class="font-semibold">{{ $product->reviews->count() > 0 ? number_format($product->reviews->avg('rating'), 1) : '0.0' }}</span>
                                    <svg class="w-4 h-4 fill-yellow-400" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                    <span class="text-xs text-gray-500">({{ $product->reviews->count() }})</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Preview"
                                    class="w-20 h-20 object-cover rounded">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-sm text-slate-600 font-medium">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 px-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
