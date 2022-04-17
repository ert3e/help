@extends('layouts.app')

@include('templates.seo.meta', ['object' => $moduleSettings])

@section('content')

    <div class="want-help">
        <div class="container">

            <h1 class="page-title">{{ $moduleSettings['meta_h1'] }}</h1>

            <div class="want-help__container">
                <div class="want-help__part">
                    {{ Form::open(['route' => 'want.help', 'class' => 'donate-form']) }}
                        <p class="donate-form__title">Сделать пожертвование</p>

                        <help-form
                            data="{{ json_encode($data) }}"
                            selected="{{ json_encode($selected) }}"
                            intervals="{{ json_encode(Payment::paymentIntervals()) }}"
                        ></help-form>

                        <div class="donate-form__row donate-form-footer">
                            <div>
                                <button class="donate-form-footer__btn" type="submit">
                                    <img src="/images/site/heart.svg" alt="heart">
                                    <span>Сделать пожертвование</span>
                                </button>
                            </div>
                            @if ($page = Page::find(4))
                                <p class="form-condition">Нажимая на кнопку, вы принимаете<br><a href="{{ route('pages', $page->slug) }}"><u>условия сбора пожертвований</u></a></p>
                            @endif
                        </div>
                    @if ($code)
                        <input name="code" value="{{ $code }}" type="hidden">
                    @endif
                    {{ Form::close() }}
                </div>

                <div class="want-help__part voll">
                    {{ Form::open(['route' => 'feedback.volunteer', 'class' => 'help-form online-form close-form']) }}
                        <p class="help-form__title">Хочу стать волонтером</p>
                        <div class="help-form__row">
                            <div class="input-group">
                                <small>Ф.И.О</small>
                                <input type="text" placeholder="Фамилия Имя Отчество" name="name">
                            </div>
                        </div>
                        <div class="help-form__row help-form-group">
                            <div class="input-group">
                                <small>Номер телефона</small>
                                <input type="text" placeholder="+7 999 999 99 99" name="telephone">
                            </div>
                            <div class="input-group">
                                <small>E-mail</small>
                                <input type="email" placeholder="name@mail.ru" name="email">
                            </div>
                        </div>
                        <div class="help-form__row help-form-group help-form-footer">
                            <div>
                                <button type="submit" class="help-form__btn">
                                    <span>Стать волонтером</span>
                                    <img src="/images/site/b-circle-arrow.svg" alt="heart">
                                </button>
                            </div>
                            <div>
                                @if ($page = Page::find(2))
                                    <p class="form-condition">Нажимая на кнопку, вы принимаете <br>условия <a href="{{ route('pages', $page->slug) }}"><u>пользовательского соглашения</u></a></p>
                                @endif
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_js')
    <script>
        const $select = document.getElementById('type');

        function render () {

            const $interval = document.getElementById('donate-form-interval'),
                $person = document.getElementById('person'),
                $program = document.getElementById('program');

            if ($select.value === 'Нужды фонда' || this.value === 'Программы фонда') {
                $interval.style = '';
            } else {
                $interval.style = 'display: none;';
            }

            if ($select.value === 'Текущие сборы') {
                $person.style = '';
            } else {
                $person.style = 'display: none;';
            }

            if ($select.value === 'Программы фонда') {
                $program.style = '';
            } else {
                $program.style = 'display: none;';
            }
        }

        $(document).ready(function () {
            //render();
        });

        //$select.addEventListener('change', render);

    </script>
@endsection
