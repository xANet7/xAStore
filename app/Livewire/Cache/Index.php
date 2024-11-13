<?php

namespace App\Livewire\Cache;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{
    protected $listeners = ['clearCache'];

    public function render()
    {
        return view('livewire.cache.index');
    }

    public function clearCache()
    {
        try {
            Artisan::call('optimize:clear');
            if (file_exists(storage_path('logs/laravel.log'))) {
                File::delete(storage_path('logs/laravel.log'));
            }
            return $this->dispatch('alert', ['title' => 'SUCCESS', 'message' => 'Cache Berhasil Dibersihkan.', 'type' => 'success']);
        } catch (\Throwable $th) {
            return $this->dispatch('alert', ['title' => 'ERROR', 'message' => 'Gagal membersihkan cache: ' . $th->getMessage(), 'type' => 'error']);
        }
    }

    public function clearCacheConfirm()
    {
        $this->dispatch('sweetalert', [
            'type' => 'warning',
            'title' => 'Apakah kamu yakin?',
            'text' => 'Apakah Anda yakin ingin membersihkan semua cache?',
            'dispatch' => 'clearCache'
        ]);
    }
}
