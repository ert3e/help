Здравствуйте! На сайте <a href="{{ \URL::to('/') }}">{{ setting('main.title') }}</a> оставили заявку на обратный звонок
<br>

<div><strong>Дата:</strong> {{ $date }}</div>
@if ($telephone != '')
    <div><strong>Номер телефона:</strong> {{ $telephone }}</div>
@endif

@include('templates.mails.template_footer')
