<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Title('Produk')]

class Index extends Component
{
    use WithPagination;

    public $productId;

    public $search = '';
    public $perPage = 10;
    public $lastItem = 0;
    public $firstItem = 0;
    public $totalData = 0;

    public $selected = [];
    public $selectAll = false;

    public $sortDir = 'DESC';
    public $sortBy = 'created_at';

    protected $listeners = [
        'delete',
        'resetSelect',
        'changeStatus',
        'selectedDelete'
    ];

    public function render()
    {
        $data = Product::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage);

        if ($data->isNotEmpty()) {
            $this->firstItem = $data->firstItem();
            $this->lastItem = $data->lastItem();
            $this->totalData = $data->total();
        }
        return view('livewire.product.index', compact('data'));
    }

    public function changeStatus()
    {
        $data = Product::findOrFail($this->productId);
        $data->update(['status' => $data->status ^ 1]);
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Produk status berhasil diupdate.', 'type' => 'success']);
    }

    public function delete()
    {
        $product = Product::findOrFail($this->productId);
        if ($product->thumbnail !== 'default.jpg' && Storage::disk('products')->exists($product->thumbnail)) {
            Storage::disk('products')->delete($product->thumbnail);
        }
        $product->delete();
        $this->reset();
        $this->resetPage();
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Produk berhasil dihapus.', 'type' => 'success']);
    }

    public function selectedDelete()
    {
        $products = Product::whereIn('id', $this->selected)->get();
        foreach ($products as $product) {
            if ($product->thumbnail !== 'default.jpg' && Storage::disk('products')->exists($product->thumbnail)) {
                Storage::disk('products')->delete($product->thumbnail);
            }
        }
        Product::whereIn('id', $this->selected)->delete();
        $this->reset();
        $this->resetPage();
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Product yang dipilih berhasil dihapus', 'type' => 'success']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->resetSelect();
    }

    public function updatedSelected()
    {
        $totalSelected = count($this->selected);
        $this->selectAll = $totalSelected === (int) $this->perPage;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = Product::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatch('closeModal');
    }

    public function resetSelect()
    {
        $this->selected = [];
        $this->selectAll = false;
    }

    public function setSortBy($sortByField)
    {
        // Jika kolom yang sama diklik, arahkan pengurutan terbalik
        if ($this->sortBy == $sortByField) {
            // Balik arah pengurutan (ASC <-> DESC)
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortDir = 'ASC';
        $this->sortBy = $sortByField;
    }

    public function changeStatusConfirm($id)
    {
        $this->productId = $id;
        $this->swalConfirmation('changeStatus');
    }

    public function deleteConfirm($id)
    {
        $this->productId = $id;
        $this->swalConfirmation('delete');
    }

    public function selectedDeleteConfirm()
    {
        $this->swalConfirmation('selectedDelete');
    }

    public function swalConfirmation($dispatch)
    {
        $this->dispatch('sweetalert', [
            'type' => 'warning',
            'title' => 'Apakah kamu yakin?',
            'text' => 'Apakah kamu yakin ingin melakukan tindakan ini?',
            'dispatch' => $dispatch
        ]);
    }
}
