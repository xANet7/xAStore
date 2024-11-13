<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Buat Produk')]

class Create extends Component
{
    use WithFileUploads;

    public $thumbnail;
    public $name;
    public $category;
    public $price;
    public $status = 1;

    public function render()
    {
        return view('livewire.product.create');
    }

    public function store()
    {
        $this->validate([
            'thumbnail' => 'nullable',
            'name' => 'required|unique:products',
            'category' => 'required',
            'price' => 'required|max:12',
            'status' => 'required',
        ]);
        $data = [
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'status' => $this->status,
        ];
        if ($this->thumbnail) {
            $filename = time() . '_' . uniqid() . '.' . $this->thumbnail->getClientOriginalExtension();
            $path = $this->thumbnail->storeAs('/', $filename, 'products');
            $data['thumbnail'] = $path;
        }
        Product::create($data);
        $this->reset();
        $this->dispatch('resetFilePond');
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Produk berhasil dibuat', 'type' => 'success']);
    }
}
