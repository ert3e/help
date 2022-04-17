
@extends('layouts.app')
@section('content')
<div class="container">
	<div class="user_cart">
		<div class="avatar"></div>
		<div class="login"><a href="#">Войти или зарегистрироваться</a></div>
	</div>
	<div class="summa_cart">
		<h4 class="wash">Ваши пожертвования</h4>
			<p class="summa"><span>0</span> ₽</p>
			<hr>
			<h4 class="ref">Помогли через мои рассылки</h4>
			<p class="summa"><span>0</span> ₽</p>
	</div>
	<div class="green_cart_accaunt"> Помогать благотворительному<br> фонду “Азим”.
		<a class="white_acc_button" href="{{ route('want.help') }}" class="banner__to-help">
			<img src="/images/site/heart.svg" alt="помочь">
			<span>Помочь Азиму</span>
		</a>
	</div>
	<a href="/programs/" class="accaunt_link program_fond">Программы фонда</a>
	<a href="/pages/kontakty/" class="accaunt_link comment_fond">Связаться с нами</a>
	<a href="/faq/" class="accaunt_link help_fond">Частые вопросы</a>
	<a href="/partners/" class="accaunt_link part_fond">Партнеры</a>
</div>
@endsection

@section('footer_js')

<script type="text/javascript">
	$('.login a').click(function() { // Вызываем функцию по нажатию на кнопку
		$('#zaglush_prof').addClass('shows');
	})
	$('#zaglush_prof').click(function() { // Обрабатываем клик по заднему фону
		$('#zaglush_prof').addClass('nones'); // Скрываем затемнённый задний фон и основное всплывающее окно
	})
</script>
@endsection

