@if ($paginator->lastPage() > 1)

    <?php $totalPages = ceil($paginator->total() / $paginator->perPage()); ?>
    <div id="pagination">
        <a class="pagination-arrow" href="{{ $paginator->url($paginator->currentPage()-1) }}"><</a>

        <a @if ($paginator->currentPage() == 1) class="pagination-active" @endif href="{{ $paginator->url(1) }}" title="Страница №1">1</a>


        @for ($ot=-2; $ot<=2; $ot++)

            @if (($paginator->currentPage()+$ot)>1 && ($paginator->currentPage())+$ot<$totalPages)
                @if ($ot==-2 && ($paginator->currentPage()+$ot) > 2) .. @endif
                @if ($ot!=0) <a href="{{ $paginator->url($paginator->currentPage() + $ot) }}" title="Страница №{{ $paginator->currentPage()+$ot }}">{{ $paginator->currentPage()+$ot }}</a>
                @else <a class="pagination-active">{{ $paginator->currentPage() }}</a> @endif
                @if ($ot==2 && ($paginator->currentPage()+$ot)<($totalPages-1)) ... @endif
            @endif

        @endfor


        <a @if ($paginator->currentPage() == $totalPages) class="pagination-active" @endif href="{{ $paginator->url($totalPages) }}" title="Страница №{{ $totalPages }}">{{ $totalPages }}</a>

        <a class="pagination-arrow" href="{{ $paginator->url( ($totalPages < $paginator->currentPage()+1) ? $totalPages : $paginator->currentPage()+1 ) }}" >></a>
    </div>
@endif
