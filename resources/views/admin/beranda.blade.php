@extends('admin.layouts.master')

@section('title', 'Beranda Admin')

@section('content')
    <!-- Stat Cards -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Produk -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ $totalProduk }}</h3>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m0 0l8-4m8 4v10l-8 4m0-10L4 7m8 4v10m0-10l8 4m-8-4l-8-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Toko -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Toko</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ $totalToko }}</h3>
                    </div>
                    <div class="bg-green-100 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Penjual Aktif -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-purple-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Penjual Aktif</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ $totalUserAktif }}</h3>
                    </div>
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Review -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-l-4 border-amber-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Review</p>
                        <h3 class="text-2xl font-bold mt-1 text-gray-800">{{ $totalReview }}</h3>
                    </div>
                    <div class="bg-amber-100 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-2-4 2V5a2 2 0 012-2h8a2 2 0 012 2v11l-4-2-4 2v-2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Produk berdasarkan Kategori (Bar Chart) -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Sebaran Produk Berdasarkan Kategori</h3>
            <div class="relative" style="height: 300px;">
                <canvas id="chartKategori"></canvas>
            </div>
        </div>

        <!-- Chart 2: Toko berdasarkan Provinsi (Pie Chart) -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Sebaran Toko Berdasarkan Provinsi</h3>
            <div class="relative" style="height: 300px;">
                <canvas id="chartProvinsi"></canvas>
            </div>
        </div>

        <!-- Chart 3: User Penjual Status (Doughnut Chart) -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Status User Penjual</h3>
            <div class="relative" style="height: 300px;">
                <canvas id="chartUserStatus"></canvas>
            </div>
        </div>

        <!-- Chart 4: Pengunjung Review (Stats) -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pengunjung & Rating</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
                    <div>
                        <p class="text-sm text-gray-600">Total Pengunjung Memberikan Review</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalReview }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-2-4 2V5a2 2 0 012-2h8a2 2 0 012 2v11l-4-2-4 2v-2" />
                    </svg>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg">
                        <p class="text-xs text-gray-600">Rating Rata-rata</p>
                        <p class="text-xl font-bold text-purple-600">
                            @php
                                $avgRating = \App\Models\Review::avg('rating');
                            @endphp
                            {{ $avgRating ? number_format($avgRating, 1) : '0' }} / 5
                        </p>
                    </div>
                    <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100 rounded-lg">
                        <p class="text-xs text-gray-600">Komentar Terisi</p>
                        <p class="text-xl font-bold text-amber-600">
                            @php
                                $commentCount = \App\Models\Review::whereNotNull('komentar')
                                    ->where('komentar', '!=', '')
                                    ->count();
                            @endphp
                            {{ $commentCount }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Chart 1: Produk berdasarkan Kategori (Bar Chart)
        const ctxKategori = document.getElementById('chartKategori').getContext('2d');
        new Chart(ctxKategori, {
            type: 'bar',
            data: {
                labels: @json(array_keys($produkByKategori)),
                datasets: [{
                    label: 'Jumlah Produk',
                    data: @json(array_values($produkByKategori)),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(249, 115, 22, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(249, 115, 22, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(59, 130, 246, 1)',
                    ],
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Chart 2: Toko berdasarkan Provinsi (Pie Chart)
        const ctxProvinsi = document.getElementById('chartProvinsi').getContext('2d');
        new Chart(ctxProvinsi, {
            type: 'pie',
            data: {
                labels: @json(array_keys($tokoByProvinsi)),
                datasets: [{
                    data: @json(array_values($tokoByProvinsi)),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(249, 115, 22, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(244, 63, 94, 0.7)',
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(249, 115, 22, 1)',
                        'rgba(236, 72, 153, 1)',
                        'rgba(14, 165, 233, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(244, 63, 94, 1)',
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Chart 3: User Penjual Status (Doughnut Chart)
        const ctxUserStatus = document.getElementById('chartUserStatus').getContext('2d');
        new Chart(ctxUserStatus, {
            type: 'doughnut',
            data: {
                labels: @json(array_keys($userSellerStatus)),
                datasets: [{
                    data: @json(array_values($userSellerStatus)),
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)', // Aktif - Green
                        'rgba(239, 68, 68, 0.7)', // Tidak Aktif - Red
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
