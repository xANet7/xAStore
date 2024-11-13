<div>
    @section('page_title', "Dashboard")
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">
    @endpush
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <p class="fw-semibold fs-18 mb-0">Halo, {{ auth()->user()->name }}!</p>
            <span class="fs-semibold text-muted">Pantau aktivitas penjualan, analisis grafik, dan kelola produk Anda dengan mudah di sini.</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-top justify-content-between">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Produk Aktif</p>
                            <div class="d-flex align-items-center">
                                <span class="fs-5 fw-semibold">{{ $activeProduct }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="avatar avatar-md avatar-rounded bg-success-transparent text-success fs-18">
                                <i class="ti ti-box fs-25"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-top justify-content-between">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Produk Nonaktif</p>
                            <div class="d-flex align-items-center">
                                <span class="fs-5 fw-semibold">{{ $inActiveProduct }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="avatar avatar-md avatar-rounded bg-danger-transparent text-danger fs-18">
                                <i class="ti ti-box fs-25"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-top justify-content-between">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Total Produk</p>
                            <div class="d-flex align-items-center">
                                <span class="fs-5 fw-semibold">{{ $totalProduct }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="avatar avatar-md avatar-rounded bg-info-transparent text-info fs-18">
                                <i class="ti ti-box fs-25"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-top justify-content-between">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Total Pengguna</p>
                            <div class="d-flex align-items-center">
                                <span class="fs-5 fw-semibold">{{ $totalUsers }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary fs-18">
                                <i class="ti ti-users fs-23"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Persentase Kategori Produk</div>
                </div>
                <div wire:ignore class="card-body">
                    @if (count($categoryCharts) > 0)
                        <div wire:ignore >
                            <div id="category-charts"></div>
                        </div>
                    @else
                        {!! showEmptyContent() !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Perkembangan Produk Baru</div>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                            View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu" >
                            <li><a class="dropdown-item @if($timeRange === 1) active @endif" href="javascript:void(0);" wire:click="setTimeRange(1)">This Week</a></li>
                            <li><a class="dropdown-item @if($timeRange === 2) active @endif" href="javascript:void(0);" wire:click="setTimeRange(2)">This Months</a></li>
                        </ul>
                    </div>
                </div>
                <div wire:ignore class="card-body">
                    <div id="product-charts"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script>
            $(document).ready(() => {
                const productResponse = {!! json_encode($productCharts) !!};
                const categoryResponse = {!! json_encode($categoryCharts) !!};

                const max = {
                    'product': productResponse.suggestedMax,
                };
                const labels = {
                    'product': productResponse.productsChartLabels,
                    'category': categoryResponse.categoryChartLabels,
                };
                const data = {
                    'product': productResponse.productsChartData,
                    'category': categoryResponse.categoryChartData,
                };

                const productChart = new ApexCharts(document.getElementById('product-charts'), {
                    series: [{
                        name: "Produk Baru",
                        data: data.product
                    }],
                    chart: {
                        type: 'area',
                        height: 350, // ukuran
                        zoom: {
                            enabled: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight',
                    },
                    grid: {
                        borderColor: '#f2f5f7',
                    },
                    labels: labels.product,
                    colors: ['#845adf'],
                    xaxis: {
                        labels: {
                            show: true,
                            style: {
                                colors: "#8c9097",
                                fontSize: '11px',
                                fontWeight: 600,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        }
                    },
                    yaxis: {
                        max: max.product,
                        labels: {
                            show: true,
                            style: {
                                colors: "#8c9097",
                                fontSize: '11px',
                                fontWeight: 600,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        }
                    },
                    tooltip: {
                        theme: "dark",
                    },
                });
                productChart.render();

                const categoryChart = new ApexCharts(document.getElementById("category-charts"), {
                    series: data.category,
                    labels: labels.category,
                    chart: {
                        type: 'donut',
                        height: 350,
                    },
                    legend: {
                        position: 'bottom',
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    colors: ["#845adf", "#23b7e5", "#f5b849", "#49b6f5", "#e6533c"],
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return `${val.toFixed(1)}%`;
                            }
                        }
                    }
                });
                categoryChart.render();

                Livewire.on('updatedChartData', ({ 0: { suggestedMax, productsChartData, productsChartLabels} }) => {
                    productChart.updateOptions({
                        xaxis: {
                            categories: productsChartLabels
                        },
                        yaxis: {
                            max: suggestedMax
                        },
                        series: [{
                            data: productsChartData
                        }]
                    });
                });
            });
        </script>
    @endpush
</div>
