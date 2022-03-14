Здравствуйте! На сайте <a href="{{ \URL::to('/') }}">{{ setting('main.title') }}</a> заказали товар
<a href="{{ route('catalog', $product->path) }}">{{ $product->title }} {{ $product->article ? '('.$product->article.')' : '' }}</a>
в 1 клик.
@if ($data['engraving'])
    <strong>С гравировкой: {{ $data['engraving'] }}</strong>
@endif
<br>

<div><strong>Дата:</strong> {{ $date }}</div>
@if ($name != '')
    <div><strong>Имя:</strong> {{ $name }}</div>
@endif
@if ($telephone != '')
    <div><strong>Номер телефона:</strong> {{ $telephone }}</div>
@endif

@include('templates.mails.template_footer')
