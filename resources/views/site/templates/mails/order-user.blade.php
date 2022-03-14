Здравствуйте!

<div>Вы оформили заказ на сайте «{{ setting('main.title') }}».</div>
<br>
<div><strong>Информация о заказе</strong></div>
<div><strong>Номер заказа:</strong> {{ $order->id }}</div>
<div><strong>Дата заказа:</strong> {{ $order->created_at }}</div>
<br>
<br>
<div><strong>Информация о клиенте – получателе заказа</strong></div>
<div><strong>Имя:</strong> {{ $order->name }}</div>
<div><strong>Контактный телефон:</strong> {{ $order->telephone }}</div>
@if ($order->email)
    <div><strong>Почта:</strong> {{ $order->email }}</div>
@endif
<div><strong>Город:</strong> {{ $order->city }}</div>
<div><strong>Адрес:</strong> {{ $order->address }}</div>
{{--
<div><strong>Способ оплаты:</strong> {{ $order->payment() }}</div>
--}}
{{--<div><strong>Способ доставки:</strong> {{ $order->delivery() }}</div>--}}
@if ($order->description)
    <div><strong>Примечание:</strong> {{ $order->description }}</div>
@endif
<br>
<br>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Категория товара</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $item)
            <tr>
                <td>{{ $item->product->id }}</td>
                <td>
                    <a href="{{ route('catalog', $item->product->path) }}" target="_blank">
                        {{ $item->product->title }}
                    </a>
                </td>
                <td>{{ $item->product->category ? $item->product->category->title : '-' }}</td>
                <td>{{ formattedPrice($item->price) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ formattedPrice($item->price * $item->quantity) }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <br>
    <div><strong>Заказ на сумму:</strong> {{ formattedPrice($order->getSum()) }}</div>
</div>

@include('templates.mails.template_footer')
