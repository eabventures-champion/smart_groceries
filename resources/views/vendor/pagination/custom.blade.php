@if ($paginator->hasPages())
<ul class="pagination justify-content-start">
    @if ($paginator->onFirstPage())
        <li class="page-link" aria-disabled="true" aria-label="@lang('pagination.previous')">
            {{-- <span aria-hidden="true">&lsaquo;</span> --}}
            <i class="fi-rs-arrow-small-left"></i>
        </li>
    @else
        <li>
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="fi-rs-arrow-small-left"></i>
            </a>
        </li>
    @endif

    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item active" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">{{ $page }}</a>
                    </li>
                @else
                    <li>
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="fi-rs-arrow-small-right"></i>
            </a>
        </li>
    @else
        <li class="page-link" aria-disabled="true" aria-label="@lang('pagination.next')">
            <i class="fi-rs-arrow-small-right"></i>
        </li>
    @endif
 </ul>
 @endif