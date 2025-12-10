<nav
    class="relative shadow-md  bg-gray/10 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex py-3 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" command="--toggle" commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-between sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('home') }}"><img src="{{ asset('build/assets/images/toekoe.png') }}"
                            alt="Toekoe" class="h-12 w-full object-cover" /></a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <form action="{{ route('produk.filter') }}" method="GET" class="w-xl mx-auto">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="search"
                                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-[#1154D4] rounded-xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Produk" />
                        </div>
                    </form>
                </div>
                @guest
                    <div class="flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <div class="sm:flex sm:gap-3 px-3">
                            <a class="inline-flex items-center justify-center rounded-md border-2 border-[#1154D4] bg-[#1154D4] px-5 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-[#1154D4] hover:border-[#1154D4] hover:shadow-lg transform hover:scale-105 transition-all duration-300"
                                href="/register">
                                Register
                            </a>
                        </div>
                        <div class="hidden sm:flex">
                            <a class="inline-flex items-center justify-center rounded-md border-2 border-[#1154D4] bg-transparent px-5 py-2 text-sm font-medium text-[#1154D4] hover:bg-[#1154D4] hover:text-white hover:border-transparent hover:shadow-lg transform hover:scale-105 transition-all duration-300"
                                href="/login">
                                Login
                            </a>
                        </div>
                    </div>
                @else
                    <div class="relative flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @auth
                            <div class="relative">
                                <button type="button" id="dropdownToggle"
                                    class="px-4 py-2 flex items-center rounded-lg text-white text-sm font-medium bg-[#1154D4] outline-none hover:bg-slate-100 border border-[#1154d4] hover:text-[#1154d4] cursor-pointer">
                                    <img src="https://readymadeui.com/profile_6.webp" class="w-7 h-7 mr-3 rounded-full shrink-0"
                                        alt="Profile" />
                                    {{ Auth::user()->nama_toko }}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-3 fill-white 
                                     inline ml-3 hover:fill-[#1154d4]"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <ul id="dropdownMenu"
                                    class="absolute hidden shadow-lg bg-white py-2 z-[1000] min-w-full w-max rounded-lg max-h-96 overflow-auto top-full right-0 mt-2">
                                    @if (Auth::user()->isAdmin())
                                        <li
                                            class="dropdown-item py-2.5 px-5 flex items-center hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer">
                                            <a href="{{ route('admin.beranda') }}"
                                                class="flex items-center w-full text-[#1154d4]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 fill-[#1154d4]"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0">
                                                    </path>
                                                </svg>
                                                Dashboard
                                            </a>
                                        </li>
                                    @else
                                        <li
                                            class="dropdown-item py-2.5 px-5 flex items-center hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer">
                                            <a href="{{ route('seller.beranda') }}"
                                                class="flex items-center w-full text-[#1154d4]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 fill-[#1154d4]"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0">
                                                    </path>
                                                </svg>
                                                Dashboard
                                            </a>
                                        </li>
                                    @endif
                                    <li
                                        class="dropdown-item py-2.5 px-5 flex items-center hover:bg-slate-100 text-slate-600 font-medium text-sm cursor-pointer">
                                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full text-[#1154d4]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3 fill-[#1154d4]"
                                                    viewBox="0 0 6.35 6.35">
                                                    <path
                                                        d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z">
                                                    </path>
                                                </svg>
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <el-disclosure id="mobile-menu" hidden class="block sm:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
            <a href="#" aria-current="page"
                class="block rounded-md bg-gray-950/50 px-3 py-2 text-base font-medium text-white">Dashboard</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
        </div>
    </el-disclosure>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let dropdownToggle = document.getElementById('dropdownToggle');
        let dropdownMenu = document.getElementById('dropdownMenu');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('block');
        }

        if (!dropdownToggle || !dropdownMenu) return;

        function hideDropdown() {
            dropdownMenu.classList.add('hidden');
            dropdownMenu.classList.remove('block');
        }

        dropdownToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleDropdown();
        });

        dropdownMenu.querySelectorAll('.dropdown-item').forEach((li) => {
            li.addEventListener('click', () => {
                hideDropdown();
            });
        });


        document.addEventListener('click', (event) => {
            if (!dropdownMenu.contains(event.target) && event.target !== dropdownToggle) {
                hideDropdown();
            }
        });
    });
</script>
