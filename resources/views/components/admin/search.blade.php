<form class="form-inline navbar-search mb-3" action="{{ $url ?? url()->current() }}" method="GET">
    <div class="input-group w-100">
        <input type="text" name="search" value="{{ request()->query('search') }}" class="form-control"
            placeholder="{{ $placeholder ?? 'Cari...' }}" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
