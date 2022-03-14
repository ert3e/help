Здравствуйте! На сайте <a href="{{ \URL::to('/') }}">{{ setting('main.title') }}</a> оставили обратную связь
<br>

<div><strong>Дата:</strong> {{ $date }}</div>
@if ($name != '')
    <div><strong>Имя:</strong> {{ $name }}</div>
@endif
@if ($email != '')
    <div><strong>E-mail:</strong> {{ $email }}</div>
@endif
@if ($telephone != '')
    <div><strong>Номер телефона:</strong> {{ $telephone }}</div>
@endif
@if ($description != '')
    <div><strong>Обращение:</strong> {{ $description }}</div>
@endif

@include('templates.mails.template_footer')
