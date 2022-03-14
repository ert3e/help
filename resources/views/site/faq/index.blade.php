@extends('layouts.app')

@include('templates.seo.meta', ['object' => setting('faq')])

@section('content')


    <div class="questions">
        <div class="container">

            <h1 class="page-title">@include('templates.seo.title', ['object' => setting('faq')])</h1>

            <div class="my-grid">
                <div class="my-grid-left">
                    <div class="questions__list">

                        @foreach($models as $key => $model)
                            @include('faq._question')
                        @endforeach

                    </div>
                </div>
                <div class="my-grid-right">
                    {{ Form::open(['route' => 'feedback.default', 'class' => 'questions-form online-form close-form', 'autocomplete' => 'off']) }}

                    <p class="questions-form__title">Задайте свой вопрос</p>
                        <div class="input-group">
                            <small>Ф.И.О</small>
                            <input type="text" class="sos-form__input" placeholder="Фамилия Имя Отчество" name="name">
                        </div>
                        <div class="input-group">
                            <small>E-mail *</small>
                            <input type="text" class="sos-form__input" placeholder="username@mail.ru" name="email">
                        </div>
                        <div class="input-group">
                            <small>Сообщение *</small>
                            <textarea class="input-group__tarea" placeholder="Напишите сообщение..." name="description"></textarea>
                        </div>

                        <button type="submit" class="questions-form__btn">
                            <span>Отправить сообщение</span>
                            <img src="/images/site/white-btn-arrow.svg" alt="icon">
                        </button>

                        @if ($page = Page::find(2))
                        <p class="form-condition">Нажимая на кнопку, вы принимаете условия<br><a href="{{ route('pages', $page->slug) }}"><u>пользовательского соглашения</u></a></p>
                        @endif

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>

    @include('templates.seo.microdata.FAQ', ['items' => $models])

@endsection


@section('footer_js')
    <script>
        $(".questions-item").click(function () {
            const $this = $(this);
            const icon = $this.find('.fas');

            if ($this.hasClass("questions-item_active")) {
                $this.removeClass("questions-item_active");
                icon.removeClass('fa-minus');
                icon.addClass('fa-plus');
            } else {
                $this.addClass("questions-item_active");
                icon.removeClass('fa-plus');
                icon.addClass('fa-minus');
            }
        });
    </script>
@endsection
