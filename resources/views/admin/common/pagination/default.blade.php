@if ($paginator->hasPages())
    <div class="fixed-table-pagination">
        <div class="float-left pagination-detail">
            <span class="pagination-info">
                本页显示第 {{ (($paginator->currentPage() - 1) * $paginator->perPage()) + 1 }} -
                @if ($paginator->currentPage() == $paginator->lastPage())
                    {{ $paginator->total() }}
                @else
                    {{ ($paginator->currentPage()) * $paginator->perPage() }}
                @endif
                ，总共 {{ $paginator->total() }} 条记录
            </span>
        </div>
        <div class="float-right pagination">
            <ul class="pagination pagination-mini">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">上一页</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">上一页</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">下一页</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">下一页</span></li>
                @endif
            </ul>
        </div>
    </div>
@else
    <div class="fixed-table-pagination">
        <div class="float-left pagination-detail">
            <span class="pagination-info">
                本页显示第 {{ (($paginator->currentPage() - 1) * $paginator->perPage()) + 1 }} -
                @if ($paginator->currentPage() == $paginator->lastPage())
                    {{ $paginator->total() }}
                @else
                    {{ ($paginator->currentPage()) * $paginator->perPage() }}
                @endif
                ，总共 {{ $paginator->total() }} 条记录
            </span>
        </div>
    </div>
@endif
