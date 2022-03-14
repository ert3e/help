Здравствуйте {{ $user->name.' '.$user->last_name }}! Вы запросили изменение пароля для своего аккаунта.
Если вы этого не делали, то проигнорируйте данное письмо.
<br>
Для восстановления пароля перейдите по ссылке: <a href="{{ route('recovery.reset', $user->reset->token) }}">восстановление пароля</a>!

@include('templates.mails.template_footer')
