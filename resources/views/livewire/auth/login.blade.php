<div>
    <form wire:submit="login">
        <div class="row gy-3">
            <div class="col-xl-12">
                <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                <input wire:model="username" type="text" class="form-control shadow-none @error('username') is-invalid @enderror" placeholder="Masukan username anda" />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xl-12 mb-2">
                <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                <input wire:model="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" placeholder="Masukan password anda">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <div class="form-check">
                        <input wire:model="remember" class="form-check-input" type="checkbox" />
                        <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                            Remember me?
                        </label>
                        <a href="javascript:void(0)" class="float-end text-muted">Lupa password?</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-login" wire:loading.attr="disabled">
                    <div wire:loading wire:target="login">
                        <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                        Loading...
                    </div>
                    <span wire:loading.remove>Login</span>
                </button>
            </div>
        </div>
    </form>
</div>
