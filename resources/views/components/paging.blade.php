<ul class="nav pagination justify-content-end">
    @if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('Previous')">
            <span class="page-link" aria-hidden="true">@lang('Previous')</span>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('Previous')">@lang('Previous')</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('Next')">@lang('Next')</a>
        </li>
    @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('Next')">
            <span class="page-link" aria-hidden="true">@lang('Next')</span>
        </li>
    @endif

    @endif
    <li class="page-item">
        <a href="#" class="page-link bg-primary text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >{{ __(':count Per page', ['count' => config('view.items_per_page')]) }}</a>
        <div class="dropdown-menu" >
            @foreach (config('view.per_page') as $per_page)
            <a class="dropdown-item @if(config('view.items_per_page') == $per_page) active @endif" href="{{ $paginator->appends('perPage', $per_page)->url(1) }}">{{ __($per_page) }}</a>
            @endforeach
        </div>
    </li>
</ul>
