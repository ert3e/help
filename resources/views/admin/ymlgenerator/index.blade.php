@extends('layouts.app')

@section('content')


    <div id="sitemap_info">
        <div class="text-dark">
            Yml каталог необходим для добавления турбо-страниц в Яндекс, а так же для регистрации на маркетплейсе Яндекс.Маркет. <br>
            Так же, зачастую он необходим для интеграции с CRM системами.
        </div>
        <h4>
            Время генерации зависит от объема информации на сайте
        </h4>
        <p class="text-left">
            <a href="{{ route('admin.ymlgenerator.generate') }}" class="btn btn-danger"><i class="fa fa-globe" aria-hidden="true"></i> Сгенерировать yml</a>
        </p>
        @if (file_exists('out.xml'))
            <b>Yml обновлялся:</b> {{ \Carbon\Carbon::createFromTimestampUTC(filectime('out.xml')) }}<br/>
            <b>Ссылка на каталог:</b> <a href="/out.xml" class="label label-primary" target="_blank">открыть</a>
        @endif
    </div>

@endsection
