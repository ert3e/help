<div class="donation">
    <div class="container">

        <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>

        <div class="my-grid">
            <div class="my-grid-left">

                <div class="my-grid-row">
                    {{ Form::open(['route' => 'donation', 'class' => 'donation-form']) }}
                        <p class="donation-form__title">Расчет закята</p>

                        <div class="donation-form__row donation-form__inputs">
                            <div class="input-group">
                                <small>Наличные</small>
                                <input type="number" class="input-group__input" placeholder="0 ₽" name="cash">
                            </div>
                            <div class="input-group">
                                <small>Деньги в банке</small>
                                <input type="number" class="input-group__input" placeholder="0 ₽" name="bank">
                            </div>
                            <div class="input-group">
                                <small>Товары и доходы</small>
                                <input type="number" class="input-group__input" placeholder="0 ₽" name="goods">
                            </div>
                            <div class="input-group">
                                <small>Золото и серебро</small>
                                <input type="number" class="input-group__input" placeholder="0 ₽" name="gold">
                            </div>
                        </div>

                        <div class="donation-form__row donation-form__result">

                            <div class="donation-form-total">
                                <p class="donation-form-total__label">Ваш закят</p>
                                <b class="donation-form-total__sum"><span>0</span> ₽</b>
                                <input type="number" name="sum_number" required min="1" style="display: none;">
                            </div>

                            <button class="donation-form__give">
                                <span>Выплатить</span>
                                <img src="/images/site/b-circle-arrow.svg" alt="icon">
                            </button>

                            <button class="donation-form__calc">
                                <img src="/images/site/calc.svg" alt="calc">
                                <span>Рассчитать</span>
                            </button>
                        </div>
                    {{ Form::close() }}
                </div>

                <div class="my-grid-row">
                    <div class="my-grid__photo">
                        <img src="/images/site/program3.png" alt="image">
                    </div>
                </div>

                @if ($model->description)
                <div class="default-description">
                    <div class="default-description">
                        {!! $model->description !!}
                    </div>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>
