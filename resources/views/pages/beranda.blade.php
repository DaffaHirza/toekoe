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
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl flex flex-col shadow-md overflow-hidden transition-all">
                            <div class="w-full bg-gray-50">
                                <a href="/" class="block">
                                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="Product 1"
                                        class="w-full object-cover object-top aspect-[230/307]" />
                                </a>
                            </div>
                            <div class="p-2 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <a href="javascript:void(0)" class="block border-0 outline-0">
                                        <h5 class="text-sm sm:text-base font-semibold text-slate-900 truncate">Crimson
                                            Grace
                                            Gown</h5>
                                    </a>
                                    <p class="text-sm mt-1 text-slate-600 truncate">Flowy and elegant red dress</p>
                                    <div class="flex flex-wrap justify-between gap-2 mt-3">
                                        <div class="flex gap-2">
                                            <h6 class="text-sm sm:text-base font-bold text-slate-900">$10</h6>
                                            <h6 class="text-sm sm:text-base text-slate-600"></h6>
                                        </div>
                                        <div class="flex items-center gap-0.5">
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-blue-600" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                            <svg class="w-[14px] h-[14px] fill-[#CED5D8]" viewBox="0 0 14 13"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4">
                                    <div class="bg-pink-200 hover:bg-pink-300 w-12 h-9 flex items-center justify-center rounded-sm cursor-pointer"
                                        title="Wishlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                                            <path
                                                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                                data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="text-sm font-medium px-2 cursor-pointer min-h-[36px] w-full bg-blue-500 hover:bg-blue-700 text-white tracking-wide ml-auto outline-0 border-0 rounded-sm">Add
                                        to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
