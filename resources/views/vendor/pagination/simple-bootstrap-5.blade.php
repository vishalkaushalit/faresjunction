@if ($paginator->hasPages())
    <nav class="dashboard-pagination d-flex justify-content-end" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <ul class="pagination mb-0">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&laquo; {{ __('Previous') }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; {{ __('Previous') }}</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Next') }} &raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ __('Next') }} &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
