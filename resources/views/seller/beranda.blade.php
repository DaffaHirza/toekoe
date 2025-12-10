@extends('seller.layouts.master')

@section('title', 'Dashboard Seller')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Seller</h1>
            <p class="text-gray-600 mt-1">Pantau statistik toko dan produk Anda</p>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Produk -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProduk }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Stok -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Stok</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalStok }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cubes text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Review -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Review</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalReview }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Rata-rata Rating -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Rata-rata Rating</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($rataRating, 1) }}</p>
                        <p class="text-xs text-gray-500 mt-1">dari 5.0</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-heart text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 1: Stok Produk -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Stok Per Produk</h3>
                    <p class="text-sm text-gray-500">Distribusi stok untuk setiap produk</p>
                </div>
                <div class="relative" style="height: 300px;">
                    <canvas id="stokChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Rating Produk -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Rating Per Produk</h3>
                    <p class="text-sm text-gray-500">Rata-rata rating dan jumlah review</p>
                </div>
                <div class="relative" style="height: 300px;">
                    <canvas id="ratingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart 3: Rating by Provinsi (Full Width) -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Pemberi Rating Berdasarkan Provinsi</h3>
                <p class="text-sm text-gray-500">Jumlah rating dari setiap provinsi</p>
            </div>
            <div class="relative" style="height: 350px;">
                <canvas id="provinsiChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Data dari controller
        const stokProduk = @json($stokProduk);
        const ratingProduk = @json($ratingProduk);
        const ratingByProvinsi = @json($ratingByProvinsi);

        // Chart 1: Stok Per Produk (Horizontal Bar)
        const stokCtx = document.getElementById('stokChart').getContext('2d');
        new Chart(stokCtx, {
            type: 'bar',
            data: {
                labels: stokProduk.map(p => p.nama),
                datasets: [{
                    label: 'Stok',
                    data: stokProduk.map(p => p.stok),
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                        '#06b6d4', '#ec4899', '#14b8a6', '#f97316', '#6366f1'
                    ],
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Chart 2: Rating Per Produk (Mixed: Line and Bar)
        const ratingCtx = document.getElementById('ratingChart').getContext('2d');
        new Chart(ratingCtx, {
            type: 'bar',
            data: {
                labels: ratingProduk.map(p => p.nama),
                datasets: [{
                        type: 'line',
                        label: 'Rata-rata Rating',
                        data: ratingProduk.map(p => parseFloat(p.rata_rating)),
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: '#f59e0b',
                        yAxisID: 'y',
                        tension: 0.3
                    },
                    {
                        type: 'bar',
                        label: 'Jumlah Review',
                        data: ratingProduk.map(p => p.total_rating),
                        backgroundColor: '#3b82f6',
                        borderRadius: 8,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Rating (0-5)',
                            font: {
                                weight: 'bold'
                            }
                        },
                        max: 5
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Jumlah Review',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });

        // Chart 3: Rating by Provinsi (Horizontal Bar)
        const provinsiCtx = document.getElementById('provinsiChart').getContext('2d');
        new Chart(provinsiCtx, {
            type: 'bar',
            data: {
                labels: ratingByProvinsi.map(p => p.provinsi || 'Tidak Diketahui'),
                datasets: [{
                    label: 'Jumlah Rating',
                    data: ratingByProvinsi.map(p => p.total_rating),
                    backgroundColor: ratingByProvinsi.map((_, index) => {
                        const colors = [
                            '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
                            '#06b6d4', '#ec4899', '#14b8a6', '#f97316', '#6366f1',
                            '#84cc16', '#14b8a6', '#0ea5e9', '#a855f7'
                        ];
                        return colors[index % colors.length];
                    }),
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endsection
