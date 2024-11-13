<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

#[Title('Edit Produk')]

class Edit extends Component
{
    use WithFileUploads;

    public $name;
    public $price;
    public $status;
    public $product;
    public $category;
    public $thumbnail;
    public $productId;
    public $oldThumbnail;

    protected $listeners = [
        'deleteThumbnail',
    ];

    public function mount($id)
    {
        $this->productId = $id;
        $this->initialize();
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function initialize()
    {
        $this->product = Product::findOrFail($this->productId);
        $this->name = $this->product->name;
        $this->category = $this->product->category;
        $this->price = $this->product->price;
        $this->status = $this->product->status;
        $this->oldThumbnail = $this->product->thumbnail;
    }

    public function update()
    {
        $this->validate([
            'thumbnail' => 'nullable',
            'name' => [
                'required',
                Rule::unique('products')->ignore($this->product->id),
            ],
            'category' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        if ($this->thumbnail) {
            $filename = time() . '_' . uniqid() . '.' . $this->thumbnail->getClientOriginalExtension();
            $path = $this->thumbnail->storeAs('/', $filename, 'products');
            $this->product->thumbnail = $path;
        }
        $this->product->name = $this->name;
        $this->product->category = $this->category;
        $this->product->price = $this->price;
        $this->product->status = $this->status;
        $this->product->update();
        $this->initialize();
        $this->reset('thumbnail');
        $this->dispatch('resetFilePond');
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Produk berhasil diupdate.', 'type' => 'success']);
    }

    public function deleteThumbnailConfirm() {
        $this->dispatch('sweetalert', [
            'type' => 'warning',
            'title' => 'Apakah kamu yakin?',
            'text' => 'Apakah kamu yakin ingin melakukan tindakan ini?',
            'dispatch' => 'deleteThumbnail'
        ]);
    }

    public function deleteThumbnail() {
        if ($this->product->thumbnail !== 'default.jpg') {
            if (Storage::disk('products')->exists($this->product->thumbnail)) {
                Storage::disk('products')->delete($this->product->thumbnail);
            }
            $this->product->thumbnail = 'default.jpg';
            $this->product->update();
        }
        $this->initialize();
        return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Gambar berhasil dihapus.', 'type' => 'success']);
    }
}
