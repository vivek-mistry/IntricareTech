@props([
    'id' => 'scrollable-modal',
    'title' => 'Modal Title',
    'size' => '', // Optional: 'modal-lg', 'modal-sm' or empty for default
    'form' => 'form',
    'action' => '#',
    'method' => 'GET',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Title"
    aria-hidden="true">
    <div class="modal-dialog {{ $size }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ $form }}" method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method($method)
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    @yield('modalFooter')
                </div>
            </form>
        </div>
    </div>
</div>
