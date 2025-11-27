@extends('admin.layouts.master')

@section('title', 'Data Category Admin')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="font-bold text-2xl">Data Kategori</h1>
        <a href="#" class="py-3 px-5 bg-blue-500 text-white rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="#ffff" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M16 0c-8.836 0-16 7.163-16 16s7.163 16 16 16c8.837 0 16-7.163 16-16s-7.163-16-16-16zM16 30.032c-7.72 0-14-6.312-14-14.032s6.28-14 14-14 14 6.28 14 14-6.28 14.032-14 14.032zM23 15h-6v-6c0-0.552-0.448-1-1-1s-1 0.448-1 1v6h-6c-0.552 0-1 0.448-1 1s0.448 1 1 1h6v6c0 0.552 0.448 1 1 1s1-0.448 1-1v-6h6c0.552 0 1-0.448 1-1s-0.448-1-1-1z">
                    </path>
                </g>
            </svg>
            Tambah Kategori
        </a>
    </div>
    <div class="overflow-x-auto my-6">
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

                            No
                        </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                        <div class="flex items-center">
                            Nama Kategori
                        </div>
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-500 inline mr-2"
                                viewBox="0 0 24 24">
                                <g transform="matrix(1.05 0 0 1.05 -.6 -.6)">
                                    <path
                                        d="M19 22.75H5c-2.07 0-3.75-1.68-3.75-3.75V7c0-2.07 1.68-3.75 3.75-3.75h14c2.07 0 3.75 1.68 3.75 3.75v12c0 2.07-1.68 3.75-3.75 3.75zm-14-18C3.76 4.75 2.75 5.76 2.75 7v12c0 1.24 1.01 2.25 2.25 2.25h14c1.24 0 2.25-1.01 2.25-2.25V7c0-1.24-1.01-2.25-2.25-2.25z"
                                        data-original="#000000" />
                                    <path
                                        d="M22 9.75H2c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h20c.41 0 .75.34.75.75s-.34.75-.75.75zm-5-5c-.41 0-.75-.34-.75-.75V2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .41-.34.75-.75.75zm-10 0c-.41 0-.75-.34-.75-.75V2c0-.41.34-.75.75-.75s.75.34.75.75v2c0 .41-.34.75-.75.75z"
                                        data-original="#000000" />
                                    <circle cx="7" cy="13" r="1" data-original="#000000" />
                                    <circle cx="12" cy="13" r="1" data-original="#000000" />
                                    <circle cx="17" cy="13" r="1" data-original="#000000" />
                                    <circle cx="7" cy="18" r="1" data-original="#000000" />
                                    <circle cx="12" cy="18" r="1" data-original="#000000" />
                                    <circle cx="17" cy="18" r="1" data-original="#000000" />
                                </g>
                            </svg>
                            Tanggal Pembuatan
                        </div>
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-slate-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-500 inline mr-2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 23.5C5.675 23.5.5 18.325.5 12S5.675.5 12 .5c.69 0 1.15.46 1.15 1.15S12.69 2.8 12 2.8c-5.06 0-9.2 4.14-9.2 9.2s4.14 9.2 9.2 9.2 9.2-4.14 9.2-9.2c0-.69.46-1.15 1.15-1.15s1.15.46 1.15 1.15c0 6.325-5.175 11.5-11.5 11.5z"
                                    data-original="#000000" />
                                <path
                                    d="M12 18.325c-3.45 0-6.325-2.875-6.325-6.325S8.55 5.675 12 5.675c.69 0 1.15.46 1.15 1.15s-.46 1.15-1.15 1.15c-2.185 0-4.025 1.84-4.025 4.025s1.84 4.025 4.025 4.025 4.025-1.84 4.025-4.025c0-.69.46-1.15 1.15-1.15s1.15.46 1.15 1.15c0 3.45-2.875 6.325-6.325 6.325z"
                                    data-original="#000000" />
                                <path
                                    d="M12 13.15c-.345 0-.575-.115-.805-.345-.46-.46-.46-1.15 0-1.61l3.68-3.68c.46-.46 1.15-.46 1.61 0s.46 1.15 0 1.61l-3.565 3.68c-.345.23-.575.345-.92.345z"
                                    data-original="#000000" />
                                <path
                                    d="M19.245 9.585h-3.68c-.69 0-1.15-.46-1.15-1.15v-3.68c0-.345.115-.575.345-.805L17.865.845c.345-.345.805-.46 1.265-.23s.69.575.69 1.035v2.415h2.53c.46 0 .92.23 1.035.69.23.46.115.92-.23 1.265L20.05 9.24c-.23.115-.46.345-.805.345zm-2.53-2.3h1.955l.805-.805h-.805c-.69 0-1.15-.46-1.15-1.15v-.92l-.805.805z"
                                    data-original="#000000" />
                            </svg>
                            Action
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap divide-y divide-gray-200">

                @forelse($categories as $category)
                    <tr>
                        <td class="pl-4 w-8">
                            <input id="checkbox9" type="checkbox" class="hidden peer" />
                            <label for="checkbox9"
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
                                    <p>{{ $category->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                            {{ $category->nama }}
                        </td>

                        <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                            {{ $category->created_at?->format('d M Y') }}
                        </td>
                        <td class="flex gap-3 px-4 py-3 text-sm font-medium">
                            <button type="button"
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
                                Edit
                            </button>
                            <button type="button"
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
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
