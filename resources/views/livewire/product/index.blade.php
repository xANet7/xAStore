<div>
    @section('page_title', "Produk")
    <div class="col-lg-12">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Produk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
        <div class="card custom-card">
            <div class="card-header d-flex flex-wrap justify-content-between gap-2">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-glare label-btn"><i class="ti ti-plus label-btn-icon me-2"></i>Buat baru</a>
                    <button type="button" wire:click="selectedDeleteConfirm" wire:loading.attr="disabled" class="btn btn-danger btn-glare label-btn @if (!$selected) d-none @endif">
                        <span wire:loading wire:target="selectedDeleteConfirm">
                            <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
                            Loading...
                        </span>
                        <span wire:loading.remove wire:target="selectedDeleteConfirm"><i class="ti ti-trash label-btn-icon me-2"></i>Hapus yang dipilih</span>
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <div class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" placeholder="Search..." wire:model.live.debounce.200ms="search" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                    <select class="form-select" id="select2" wire:model.live="perPage" style="max-width: 80px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th width="50px">
                                <div class="d-flex justify-content-center form-check form-check-md">
                                    <input class="form-check-input shadow-none" id="selectAll" type="checkbox" wire:model.live="selectAll" @disabled($data->isEmpty()) />
                                </div>
                            </th>
                            <th width="50px">#</th>
                            @include('components.includes.table-sortable', [
                                'name' => 'thumbnail',
                                'displayTitle' => 'Thumbnail'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'name',
                                'displayTitle' => 'Produk'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'category',
                                'displayTitle' => 'Kategori'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'price',
                                'displayTitle' => 'Harga'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'status',
                                'displayTitle' => 'Status'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'created_at',
                                'displayTitle' => 'Tanggal dibuat'
                            ])
                            @include('components.includes.table-sortable', [
                                'name' => 'updated_at',
                                'displayTitle' => 'Tanggal diperbarui'
                            ])
                            <th class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td>
                                    <div class="d-flex justify-content-center form-check form-check-md"><input class="form-check-input select-item shadow-none" type="checkbox" wire:model.live="selected" value="{{ $item->id }}"></div>
                                </td>
                                <td>{{ $loop->index + $firstItem }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/products/' . $item->thumbnail) }}" class="rounded" alt="Product Image" width="150" height="90">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ convertIDR($item->price) }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y H:i A') }}</td>
                                <td>{{ $item->updated_at->format('d M Y H:i A') }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-15 justify-content-center">
                                        <a href="{{ route('product.edit', [$item->id]) }}" class="text-primary" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <div wire:click="changeStatusConfirm({{ $item->id }})" class="text-warning" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Ubah Status">
                                            <span wire:loading wire:target="changeStatusConfirm({{ $item->id }})" class="spinner-border spinner-border-sm text-warning"></span>
                                            <span wire:loading.remove wire:target="changeStatusConfirm({{ $item->id }})">
                                                <i class="ri-arrow-left-right-line"></i>
                                            </span>
                                        </div>
                                        <div wire:click="deleteConfirm({{ $item->id }})" class="text-danger" style="cursor: pointer;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Hapus">
                                            <span wire:loading wire:target="deleteConfirm({{ $item->id }})" class="spinner-border spinner-border-sm text-danger"></span>
                                            <span wire:loading.remove wire:target="deleteConfirm({{ $item->id }})">
                                                <i class="ri-delete-bin-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="text-center">Data tidak tersedia saat ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 my-3">
                @if ($data->total() > $perPage)
                    {{ $data->links() }}
                @else
                    <small>Menampilkan {{ $data->firstItem() ?? 0 }} hingga {{ $data->lastItem() ?? 0 }} dari {{ $data->total() ?? 0 }} entri</small>
                @endif
            </div>
        </div>
    </div>
</div>
