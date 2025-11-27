<nav id="sidebar" class="lg:min-w-[250px] w-max max-lg:min-w-8">
    <div id="sidebar-collapse-menu"
        class="bg-blue-500 shadow-lg h-screen fixed top-0 left-0 overflow-auto z-[99] lg:min-w-[250px] lg:w-max max-lg:w-0 max-lg:invisible transition-all duration-500">
        <div class="flex items-center justify-center gap-2 pt-6 pb-2 px-4 sticky top-0 bg-blue-500 min-h-[64px] z-[100]">
            <a href="javascript:void(0)"><img src="{{ asset('build/assets/images/toekoefooter.png') }}" alt="logo"
                    class="w-[140px]" />
            </a>
            <button id="close-sidebar" class="lg:hidden ml-auto">
                <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="py-4 px-4">
            <ul class="space-y-2">
                <a href="javascript:void(0)"
                    class="text-white text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700 rounded-md px-3 py-2.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                        viewBox="0 0 24 24">
                        <path
                            d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z"
                            data-original="#000000" />
                        <path
                            d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z"
                            data-original="#000000" />
                    </svg>
                    <span class="overflow-hidden text-ellipsis whitespace-nowrap">Dashboard</span>

                </a>


                <li>
                    <a href="javascript:void(0)"
                        class=" text-white e text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2.5 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                            viewBox="0 0 24 24">
                            <path
                                d="M18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4H6c-2.206 0-4-1.794-4-4V6c0-2.206 1.794-4 4-4zm0-2H6a6 6 0 0 0-6 6v12a6 6 0 0 0 6 6h12a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6z"
                                data-original="#000000" />
                            <path d="M12 18a1 1 0 0 1-1-1V7a1 1 0 0 1 2 0v10a1 1 0 0 1-1 1z" data-original="#000000" />
                            <path d="M6 12a1 1 0 0 1 1-1h10a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1z" data-original="#000000" />
                        </svg>
                        <span class="overflow-hidden text-ellipsis whitespace-nowrap">Data Produk</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="arrowIcon w-3 fill-current -rotate-90 ml-auto transition-all duration-500"
                            viewBox="0 0 451.847 451.847">
                            <path
                                d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                data-original="#000000" />
                        </svg>
                    </a>
                    <ul class="sub menu max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out ml-8">
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Tambah Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seller.pages.view') }}"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Lihat Produk</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.sellers.index') }}"
                        class="text-white text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2.5 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                            viewBox="0 0 512 512">
                            <path
                                d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
                                data-original="#000000" />
                        </svg>
                        <span class="overflow-hidden text-ellipsis whitespace-nowrap">Data Seller</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="arrowIcon w-3 fill-current -rotate-90 ml-auto transition-all duration-500"
                            viewBox="0 0 451.847 451.847">
                            <path
                                d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                data-original="#000000" />
                        </svg>
                    </a>
                    <ul class="sub menu max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out ml-8">
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Leads</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Visitors</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0)"
                        class="text-white text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2.5 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                            viewBox="0 0 25 25">
                            <g data-name="Action Expand">
                                <path
                                    d="M21.5 1.25h-18A2.25 2.25 0 0 0 1.25 3.5v18a2.25 2.25 0 0 0 2.25 2.25h18a2.25 2.25 0 0 0 2.25-2.25v-18a2.25 2.25 0 0 0-2.25-2.25zm.75 20.25a.75.75 0 0 1-.75.75h-18a.75.75 0 0 1-.75-.75v-18a.75.75 0 0 1 .75-.75h18a.75.75 0 0 1 .75.75z"
                                    data-original="#000000" />
                                <path d="M11.75 7.25h1.5v10.5h-1.5z" data-original="#000000" />
                                <path d="M7.25 11.75h10.5v1.5H7.25z" data-original="#000000" />
                            </g>
                        </svg>
                        <span class="overflow-hidden text-ellipsis whitespace-nowrap">Data Kategori</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="arrowIcon w-3 fill-current -rotate-90 ml-auto transition-all duration-500"
                            viewBox="0 0 451.847 451.847">
                            <path
                                d="M225.923 354.706c-8.098 0-16.195-3.092-22.369-9.263L9.27 151.157c-12.359-12.359-12.359-32.397 0-44.751 12.354-12.354 32.388-12.354 44.748 0l171.905 171.915 171.906-171.909c12.359-12.354 32.391-12.354 44.744 0 12.365 12.354 12.365 32.392 0 44.751L248.292 345.449c-6.177 6.172-14.274 9.257-22.369 9.257z"
                                data-original="#000000" />
                        </svg>
                    </a>
                    <ul class="sub menu max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out ml-8">
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Tambah Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"
                                class="text-white text-[15px] font-medium block cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2 transition-all duration-300">
                                <span>Lihat Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="mt-6">
                <h6 class="text-white e text-sm font-bold px-3">General Settings</h6>
                <ul class="mt-3 space-y-2">

                    <li>
                        <a href="javascript:void(0)"
                            class="text-white text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2.5 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z"
                                    data-original="#000000" />
                                <path
                                    d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z"
                                    data-original="#000000" />
                            </svg>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"
                            class="text-white text-[15px] font-medium flex items-center cursor-pointer hover:bg-blue-700  rounded-md px-3 py-2.5 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] mr-3 fill-current"
                                viewBox="0 0 6 6">
                                <path
                                    d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                    data-original="#000000" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<button id="open-sidebar" class="lg:hidden ml-4 mt-4 fixed top-0 left-0 bg-white z-[50]">
    <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
    </svg>
</button>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select all parent menu items with submenus
        document.querySelectorAll('#sidebar ul > li > a').forEach((menu) => {
            menu.addEventListener('click', () => {
                const subMenu = menu.nextElementSibling;
                if (!subMenu) return;
                const arrowIcon = menu.querySelector('.arrowIcon');

                // Check if the submenu is currently open
                if (subMenu.classList.contains('max-h-0')) {
                    subMenu.classList.remove('max-h-0');
                    subMenu.classList.add('max-h-[500px]'); // Adjust height as needed
                } else {
                    subMenu.classList.remove('max-h-[500px]');
                    subMenu.classList.add('max-h-0');
                }

                // Toggle arrow rotation
                arrowIcon.classList.toggle('rotate-0');
                arrowIcon.classList.toggle('-rotate-90');
            });
        });

        let sidebarCloseBtn = document.getElementById('close-sidebar');
        let sidebarOpenBtn = document.getElementById('open-sidebar');
        let sidebarCollapseMenu = document.getElementById('sidebar-collapse-menu');

        sidebarOpenBtn.addEventListener('click', () => {
            sidebarCollapseMenu.style.cssText = 'width: 250px; visibility: visible; opacity: 1;';
        });

        sidebarCloseBtn.addEventListener('click', () => {
            sidebarCollapseMenu.style.cssText = 'width: 32px; visibility: hidden; opacity: 0;';
        });
    });
</script>
