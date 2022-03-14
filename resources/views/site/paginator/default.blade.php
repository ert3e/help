@if ($paginator->lastPage() > 1)

    <?php $totalPages = ceil($paginator->total() / $paginator->perPage()); ?>

    <div class="reviews__pagination">
        <div class="pagination">
            <ul class="pagination__list">


                @if ($paginator->currentPage() != 1)
                    <li>
                        <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="pagination__change pagination__prev">
                            <img src="/images/site/pag-prev-arrow.svg" alt="предыдущая страница">
                        </a>
                    </li>
                @endif


                <li class="pagination__item">
                    <a href="{{ $paginator->url(1) }}" class="pagination__link @if ($paginator->currentPage() == 1) pagination__num_active @endif" title="Страница №1">1</a>
                </li>

                @for ($ot=-2; $ot<=2; $ot++)

                    @if (($paginator->currentPage()+$ot)>1 && ($paginator->currentPage())+$ot<$totalPages)
                        @if ($ot==-2 && ($paginator->currentPage()+$ot) > 2) <li class="pagination__item"><span>...</span></li> @endif
                        @if ($ot!=0) <li class="pagination__item"><a href="{{ $paginator->url($paginator->currentPage()+$ot) }}" class="pagination__link" title="Страница №{{ $paginator->currentPage()+$ot }}">{{ $paginator->currentPage()+$ot }}</a></li>
                        @else <li class="pagination__item"><a class="pagination__link pagination__num_active">{{ $paginator->currentPage() }}</a></li> @endif
                        @if ($ot==2 && ($paginator->currentPage()+$ot)<($totalPages-1)) <li class="pagination__item"><span>...</span></li> @endif
                    @endif

                @endfor

                <li class="pagination__item">
                    <a href="{{ $paginator->url($totalPages) }}" class="@if ($paginator->currentPage() == $totalPages) pagination__num_active @endif" title="Страница №{{ $totalPages }}">{{ $totalPages }}</a>
                </li>


                @if ($paginator->currentPage() != $totalPages)
                    <li>
                        <a href="{{ $paginator->url( ($totalPages < $paginator->currentPage()+1) ? $totalPages : $paginator->currentPage()+1 ) }}"  class="pagination__change pagination__next">
                            <img src="/images/site/pag-next-arrow.svg" alt="следующая страница">
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
