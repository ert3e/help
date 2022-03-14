   


@extends('layouts.app')

@include('templates.seo.meta', ['object' => setting('news')])

@section('content')

    <div class="articles news_m">
         <h1 class="page-title page-title-webapp">{{ setting('news.meta_h1') }}</h1>
        <div class="container">

            <h1 class="page-title page-title-desk">{{ setting('news.meta_h1') }}</h1>

            <div class="articles__list">
                @if (count($models) > 0)
                    @foreach($models as $model)
                        @include('_new', ['new' => $model])
                    @endforeach
                @else
                    @include('templates.blocks.empty')
                @endif
            </div>
<script  type="text/javascript">
const square = document.querySelector('.sbor');
square.style.filter = 'none';
</script>

            <div class="pagination">
                @include('paginator.default', ['paginator' => $models])
            </div>
            <style type="text/css">

            {{--<div class="pagination">
                <a href="#" class="pagination__change pagination__prev"><img src="img/pag-prev-arrow.svg" alt="prev"></a>
                <a href="#" class="pagination__item pagination__num">1</a>
                <a href="#" class="pagination__item pagination__dots">...</a>
                <a href="#" class="pagination__item pagination__num">12</a>
                <a href="#" class="pagination__item pagination__num pagination__num_active">13</a>
                <a href="#" class="pagination__item pagination__num">14</a>
                <a href="#" class="pagination__item pagination__dots">...</a>
                <a href="#" class="pagination__item pagination__num">25</a>
                <a href="#" class="pagination__change pagination__next"><img src="img/pag-next-arrow.svg" alt="next"></a>
            </div>--}}
             </style>

        </div>
    </div>

@endsection
