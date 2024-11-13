<div>
    @section('page_title', "Buat Produk")
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/libs/filepond/filepond.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/libs/filepond/filepond-plugin-image-preview.min.css') }}">
    @endpush
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Buat Produk</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buat Produk</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Upload</div>
                </div>
                <div class="card-body">
                    <div wire:ignore>
                        <input type="file" class="filepond" accept="image/*">
                    </div>
                    @error('thumbnail')
                        <div style="font-size: .875em; margin-top: .25rem; color: var(--bs-form-invalid-color); width: 100%;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">General</div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6 col-md-6">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama produk" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="category" class="form-label fw-semibold">Kategori</label>
                            <input wire:model="category" type="text" class="form-control @error('category') is-invalid @enderror" placeholder="Masukan nama kategori" />
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="price" class="form-label fw-semibold">Harga</label>
                            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Masukan harga produk" />
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div wire:ignore class="form-input">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <select wire:model="status" class="form-control select2" id="status">
                                    <option value=""></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            @error('status')
                                <div style="color: var(--bs-form-invalid-color); font-size: .875em; margin-top: .25rem">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-block">
                            <a href="{{ route('product.index') }}" class="btn btn-dark btn-glare label-btn"><i class="ti ti-arrow-left label-btn-icon me-2"></i>Kembali</a>
                            <button wire:click="store" wire:loading.attr="disabled" type="button" class="btn btn-primary btn-glare label-btn">
                                <div wire:loading wire:target="store">
                                    <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                                    Loading...
                                </div>
                                <span wire:loading.remove wire:target="store"><i class="ti ti-check label-btn-icon me-2"></i>Simpan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/libs/filepond/filepond.min.js') }}"></script>
        <script src="{{ asset('assets/libs/filepond/filepond-plugin-image-preview.min.js') }}"></script>
        <script src="{{ asset('assets/libs/filepond/filepond-plugin-file-validate-type.min.js') }}"></script>
        <script>
            (function() {
                "use strict"

                FilePond.registerPlugin(
                    FilePondPluginImagePreview,
                    FilePondPluginFileValidateType,
                );

                window.fileUpload = FilePond.create(document.querySelector('.filepond'), {
                    allowDrop: true,
                    allowBrowse: true,
                    allowImagePreview: true
                });

                FilePond.setOptions({
                    server: {
                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            @this.upload('thumbnail', file, load, error, progress);
                        },
                        revert: (filename, load) => {
                            @this.removeUpload('thumbnail', filename, load);
                        },
                    }
                })

                $('#status').on('change', function() {
                    var data = $(this).select2("val");
                    @this.set('status', data);
                });
            })();
        </script>
    @endpush
</div>
