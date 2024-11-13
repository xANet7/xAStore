<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]

class Index extends Component
{
    public $totalUsers;
    public $totalProduct;
    public $activeProduct;
    public $inActiveProduct;

    public $timeRange = 1;
    public $productCharts = [];
    public $categoryCharts = [];

    public function mount()
    {
        $this->initializeChartData();
        $this->totalUsers = User::count();
        $this->totalProduct = Product::count();
        $this->activeProduct = Product::where('status', '=', 1)->count();
        $this->inActiveProduct = Product::where('status', '=', 0)->count();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }

    public function categoryCharts()
    {
        $getCategoryData = Product::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');
        $totalProducts = $getCategoryData->sum();
        $categoryChartLabels = $getCategoryData->keys()->toArray();
        $categoryChartData = $getCategoryData->map(function ($count) use ($totalProducts) {
            return round(($count / $totalProducts) * 100, 2);
        })->values()->toArray();
        if ($getCategoryData->isNotEmpty()) {
            $this->categoryCharts = [
                'categoryChartData' => $categoryChartData,
                'categoryChartLabels' => $categoryChartLabels,
            ];
        }
    }

    public function productCharts()
    {
        if ($this->timeRange == 1) {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } else {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }
        $dates = chartDates($startDate, $endDate);
        $getProducts = Product::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(id) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $getProductsData = $dates->merge($getProducts);
        $productsChartLabels = [];
        $productsChartData = [];
        foreach ($getProductsData as $key => $value) {
            $productsChartLabels[] = Carbon::parse($key)->format('d M');
            $productsChartData[] = $value;
        }
        $suggestedMax = (max($productsChartData) > 10) ? max($productsChartData) + 2 : 10;
        $this->productCharts = [
            'suggestedMax' => $suggestedMax,
            'productsChartData' => $productsChartData,
            'productsChartLabels' => $productsChartLabels,
        ];
    }

    public function initializeChartData()
    {
        $this->productCharts();
        $this->categoryCharts();
    }

    public function setTimeRange($value)
    {
        $this->timeRange = $value;
        $this->initializeChartData();
        $this->dispatch('updatedChartData', $this->productCharts);
    }
}
