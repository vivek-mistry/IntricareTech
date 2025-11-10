@props([
    'id' => 'scrollable-modal',
    'placeholder' => 'Search...'
])

<div class="app-search d-none d-lg-block">
    <form action="#">
        <div class="input-group">
            <input type="search" id="{{ $id }}" class="form-control" placeholder="{{ $placeholder }}" autocomplete="off">
            <span class="ri-search-line search-icon text-muted"></span>
        </div>
    </form>
</div>
