@php
    $isRTL = app()->getLocale() === 'ar';
@endphp
@if ($paginator->hasPages())
    <nav class="custom-pagination" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
        <ul class="pagination-list">
            @if($isRTL)
                {{-- RTL Layout: Last (>>), Next (>), Pages (reversed), Previous (<), First (<<) --}}
                {{-- Arrow directions stay the same, only order changes --}}

                {{-- Last Page Link (rightmost in RTL) - uses >> --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-item">
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination-link" rel="last">&raquo;&raquo;</a>
                    </li>
                @else
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&raquo;&raquo;</span>
                    </li>
                @endif

                {{-- Next Page Link - uses > --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-item">
                        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&raquo;</span>
                    </li>
                @endif

                {{-- Pagination Elements (reversed for RTL) --}}
                @php
                    $reversedElements = array_reverse($elements, true);
                @endphp
                @foreach ($reversedElements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="pagination-item disabled">
                            <span class="pagination-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links (reversed) --}}
                    @if (is_array($element))
                        @php
                            $reversedPages = array_reverse($element, true);
                        @endphp
                        @foreach ($reversedPages as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination-item active">
                                    <span class="pagination-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="pagination-item">
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Previous Page Link - uses < --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&laquo;</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- First Page Link (leftmost in RTL) - uses << --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&laquo;&laquo;</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $paginator->url(1) }}" class="pagination-link" rel="first">&laquo;&laquo;</a>
                    </li>
                @endif
            @else
                {{-- LTR Layout: First, Previous, Pages, Next, Last --}}

                {{-- First Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&laquo;&laquo;</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $paginator->url(1) }}" class="pagination-link" rel="first">&laquo;&laquo;</a>
                    </li>
                @endif

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&laquo;</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="pagination-item disabled">
                            <span class="pagination-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination-item active">
                                    <span class="pagination-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="pagination-item">
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-item">
                        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&raquo;</span>
                    </li>
                @endif

                {{-- Last Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-item">
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination-link" rel="last">&raquo;&raquo;</a>
                    </li>
                @else
                    <li class="pagination-item disabled">
                        <span class="pagination-link">&raquo;&raquo;</span>
                    </li>
                @endif
            @endif
        </ul>
    </nav>
@endif

