<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel App')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    @yield('styles')
</head>

<body class="min-h-screen">
    <div class="main-content">
        <div class="bg-gray-50">
            <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
                <div class="max-w-[480px] w-full">
                    <a href="/"><img src="{{ asset('build/assets/images/toekoe.png') }}" alt="logo"
                            class="w-40 mb-8 mx-auto block" />
                    </a>

                    <div class="p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <h1 class="text-slate-900 text-center text-3xl font-semibold">Sign in</h1>
                        @if (session('status'))
                            <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="mt-4 p-3 bg-red-100 text-red-800 rounded">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST" class="mt-12 space-y-6">
                            @csrf
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">User name</label>
                                <div class="relative flex items-center">
                                    <input name="email" type="email" required
                                        class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-blue-600"
                                        placeholder="Enter email address" />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                        class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                        <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                        <path
                                            d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                            data-original="#000000"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                                <div class="relative flex items-center">
                                    <input name="password" type="password" required
                                        class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-blue-600"
                                        placeholder="Enter password" />

                                </div>
                            </div>
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember" type="checkbox"
                                        class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                                    <label for="remember-me" class="ml-3 block text-sm text-slate-900">
                                        Remember me
                                    </label>
                                </div>
                                <div class="text-sm">
                                    <a href="jajvascript:void(0);" class="text-blue-600 hover:underline font-semibold">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>

                            <div class="mt-12">
                                <button type="submit"
                                    class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none cursor-pointer">
                                    Sign in
                                </button>
                            </div>
                            <p class="text-slate-900 text-sm mt-6 text-center">Don't have an account? <a
                                    href="/register"
                                    class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register
                                    here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('scripts')
</body>

</html>
