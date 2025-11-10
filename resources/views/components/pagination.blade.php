@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-rounded mb-0 flex items-center justify-center gap-1">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled opacity-50 cursor-not-allowed">
                <span class="page-link" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Dots --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link bg-primary text-white border-primary">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->appends(request()->query())->url($page) }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        @else
            <li class="page-item disabled opacity-50 cursor-not-allowed">
                <span class="page-link" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </span>
            </li>
        @endif

    </ul>
</nav>
@endif

