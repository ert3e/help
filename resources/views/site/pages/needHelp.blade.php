@extends('layouts.app')

@include('templates.seo.meta', ['object' => $moduleSettings])

@section('content')

    <div class="sos">
        <div class="container">

            <h1 class="page-title">{{ $moduleSettings['meta_h1'] }}</h1>

            <div class="sos__container">

                {{ Form::open(['route' => 'feedback.help', 'class' => 'sos-form online-form close-form']) }}

                    <h1 class="sos-form__title">Заявка на получение помощи</h1>

                    <div class="sos-form__row">
                        <div class="input-group">
                            <small>Ф.И.О</small>
                            <input type="text" value="" class="sos-form__input" placeholder="Фамилия Имя Отчество" name="name">
                        </div>
                    </div>

                    <div class="sos-form__row">
                        <div class="input-group">
                            <small>Номер телефона *</small>
                            <input type="text" value="" class="sos-form__input" placeholder="+7 (999) 999-99-99" name="telephone" >
                        </div>
                        <div class="input-group">
                            <small>E-mail</small>
                            <input type="email" value="" class="sos-form__input" placeholder="username@mail.ru" name="email">
                        </div>
                    </div>

                    <div class="sos-form__row">
                        <div class="input-group">
                            <small>Какая помощь вам нужна? *</small>
                            <textarea class="sos-form__tarea" placeholder="Опишите вашу нужду..." name="description" ></textarea>
                        </div>
                    </div>

                    <div class="sos-form__row">
                        <div class="select-file">
                            <span class="select-file__comment">Фото (не обязательно)</span>
                            <label class="select-file__label">
                                <input name="file" type="file" class="select-file__input">
                                Выбрать файл
                            </label>
                        </div>
                    </div>

                    <div class="sos-form__row">
                        <div>
                            <button type="submit" class="sos-form__btn">
                                <span>Отправить заявку</span>
                                <img src="/images/site/white-btn-arrow.svg" alt="отправить">
                            </button>
                        </div>

                        @if ($page = Page::find(2))
                            <p class="form-condition">Нажимая на кнопку, вы принимаете условия<br><a href="{{ route('pages', $page->slug) }}"><u>пользовательского соглашения</u></a></p>
                        @endif
                    </div>

                {{ Form::close() }}

                <div>
                    <div class="sos-banner">
                        @if (setting('need-help.description'))
                        <div class="sos-banner__txt">
                            <p>{!! nl2br(setting('need-help.description')) !!}</p>
                        </div>
                        @endif
                        <div class="sos-banner__panel">
                            <?php $file = glob('storage/files/need-help/filling-form/file.*'); ?>
                            @if (isset($file[0]))
                                <a href="/{{ $file[0] }}" class="sos-banner__btn">
                                    <span>Бланк заявления</span>
                                    <img src="/images/site/save-doc.svg" alt="save">
                                </a>
                            @endif

                            <?php $file = glob('storage/files/need-help/need-documents/file.*'); ?>
                            @if (isset($file[0]))
                                <a href="/{{ $file[0] }}" class="sos-banner__btn">
                                    <span>Необходимые документы</span>
                                    <img src="/images/site/save-doc.svg" alt="save">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
