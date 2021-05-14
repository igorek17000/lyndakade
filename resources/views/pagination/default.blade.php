@if ($paginator->hasPages())
    {{--    <ul class="pagination">--}}
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a class="btn btn-sm animation-on-hover disabled">&laquo;</a>
        {{--            <li class="disabled"><span>&laquo;</span></li>--}}
    @else
        <a class="btn btn-sm animation-on-hover" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        {{--            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="btn btn-sm animation-on-hover disabled">{{ $element }}</a>
            {{--                <li class="disabled"><span>{{ $element }}</span></li>--}}
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="btn btn-sm animation-on-hover active">{{ $page }}</a>
                    {{--                        <li class="active"><span>{{ $page }}</span></li>--}}
                @else
                    <a class="btn btn-sm animation-on-hover" href="{{ $url }}">{{ $page }}</a>
                    {{--                        <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="btn btn-sm animation-on-hover" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        {{--            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
    @else
        {{--            <li class="disabled"><span>&raquo;</span></li>--}}
        <a class="btn btn-sm animation-on-hover disabled">&raquo;</a>
    @endif
    {{--    </ul>--}}
@endif
