@extends('seller.layouts.master')

@section('title', 'Data Produk')

@section('content')
    <div class="p-6">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="font-bold text-2xl">Data Produk</h1>
            <a href="{{ route('seller.pages.create') }}"
                class="text-sm cursor-pointer relative px-6 py-2.5 text-blue-600 font-semibold border border-blue-600 rounded-lg overflow-hidden group">
                <span
                    class="absolute left-0 top-0 w-full h-full bg-blue-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-in-out z-0"></span>
                <span class="relative z-10 group-hover:text-white transition-colors duration-300">Tambah Produk</span>
            </a>
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
                            <div class="flex items-center">

                                Nama Produk
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Kondisi
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Harga
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Category
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Gambar
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Stock
                            </div>
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                            <div class="flex items-center">

                                Action
                            </div>
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
                                <div class="flex items-center cursor-pointer w-max">
                                    <div class="ml-2">
                                        <p>{{ $product->nama_produk }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium max-w-xs">
                                {{ Str::limit($product->kondisi) }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                {{ $product->harga }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium max-w-xs">
                                {{ $product->category->nama }}
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Preview"
                                    class="w-20 h-20 object-cover rounded">

                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                                {{ $product->stok }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('seller.pages.edit', $product->id) }}"
                                        class="flex items-center gap-2 rounded-lg text-blue-600 bg-blue-50 border border-gray-200 px-3 py-1 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current inline"
                                            viewBox="0 0 64 64">
                                            <path
                                                d="M11.105 43.597a2 2 0 0 1-1.414-3.414L40.945 8.929a2 2 0 1 1 2.828 2.828L12.519 43.011c-.39.39-.902.586-1.414.586z"
                                                data-original="#000000" />
                                            <path
                                                d="M8.017 58a2 2 0 0 1-1.957-2.42l3.09-14.403a2 2 0 1 1 3.911.839l-3.09 14.403A2 2 0 0 1 8.017 58zm14.401-3.09a2 2 0 0 1-1.414-3.414l31.254-31.253a2 2 0 1 1 2.828 2.828L23.833 54.324a1.994 1.994 0 0 1-1.415.586z"
                                                data-original="#000000" />
                                            <path
                                                d="M8.013 58a2.001 2.001 0 0 1-.418-3.956l14.403-3.09a2 2 0 0 1 .839 3.911l-14.403 3.09a1.958 1.958 0 0 1-.421.045zm40.002-28.687a1.99 1.99 0 0 1-1.414-.586L35.288 17.414a2 2 0 1 1 2.828-2.828l11.313 11.313a2 2 0 0 1-1.414 3.414zm5.657-5.656a2 2 0 0 1-1.415-3.415c1.113-1.113 1.726-2.62 1.726-4.242s-.613-3.129-1.726-4.242c-1.114-1.114-2.621-1.727-4.243-1.727s-3.129.613-4.242 1.727a2 2 0 1 1-2.829-2.829c1.868-1.869 4.379-2.898 7.071-2.898 2.691 0 5.203 1.029 7.071 2.898 1.869 1.868 2.898 4.379 2.898 7.071s-1.029 5.203-2.898 7.071a1.99 1.99 0 0 1-1.413.586z"
                                                data-original="#000000" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('seller.pages.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus produk ini?')"
                                            class="flex items-center gap-2 rounded-lg text-red-600 bg-red-50 border border-gray-200 px-3 py-1 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current inline"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"
                                                    data-original="#000000" />
                                                <path
                                                    d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zm80 0c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zm-160 0c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"
                                                    data-original="#000000" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-3 text-center text-sm text-slate-600 font-medium">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="md:flex m-4">
                <p class="text-sm text-slate-600 flex-1">Showind 1 to 10 of 100 entries</p>

                <div class="flex items-center max-md:mt-4">
                    <p class="text-sm text-slate-600">Display</p>
                    <select class="text-sm text-slate-900 border border-gray-300 rounded-md h-9 mx-4 pl-3 pr-5 w-15 outline-none pt-0 pb-0.5">
                        <option>10</option>
                        <option>20</option> 
                        <option>50</option>
                        <option>100</option>
                    </select>

                    <ul class="flex space-x-3 justify-center">
                        <li class="flex items-center justify-center shrink-0 bg-gray-100 w-9 h-9 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400"
                                viewBox="0 0 55.753 55.753">
                                <path
                                    d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                                    data-original="#000000" />
                            </svg>
                        </li>
                        <li
                            class="flex items-center justify-center shrink-0 bg-blue-500  border hover:border-blue-500 border-blue-500 cursor-pointer text-sm font-medium text-white px-[13px] h-9 rounded-md">
                            1
                        </li>
                        <li
                            class="flex items-center justify-center shrink-0 border border-gray-300 hover:border-blue-500 cursor-pointer text-sm font-medium text-slate-900 px-[13px] h-9 rounded-md">
                            2
                        </li>
                        <li
                            class="flex items-center justify-center shrink-0 border border-gray-300 hover:border-blue-500 cursor-pointer text-sm font-medium text-slate-900 px-[13px] h-9 rounded-md">
                            3
                        </li>
                        <li
                            class="flex items-center justify-center shrink-0 border border-gray-300 hover:border-blue-500 cursor-pointer text-sm font-medium text-slate-900 px-[13px] h-9 rounded-md">
                            4
                        </li>
                        <li
                            class="flex items-center justify-center shrink-0 border border-gray-300 hover:border-blue-500 cursor-pointer w-9 h-9 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400 rotate-180"
                                viewBox="0 0 55.753 55.753">
                                <path
                                    d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"
                                    data-original="#000000" />
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
