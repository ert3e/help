<div class="about">
    <div class="container">

        <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>

        <div class="my-grid about__wrapper">


            <div class="my-grid-left">

                @if ($model->description)
                    <div class="default-description">
                        {!! $model->description !!}
                    </div>
                @endif

                <?php $employees = EmployeeBase::orderPosition()->get(); ?>
                @if (count($employees) > 0)
                <div class="my-grid-row about-team-wrapper">
                    <div class="about-team" id="about-team">
                        <h2 class="about-team__title">Команда фонда</h2>
                        <div class="about-team__list default-slider" id="about-team-slider">
                            @foreach($employees as $employee)
                            <div>
                                <div class="about-team-member">
                                    <div class="about-team-member__img">
                                        <img src="{{ $employee->mainImage(400) }}" alt="{{ $employee->fio }}">
                                    </div>
                                    <p class="about-team-member__title">{{ $employee->fio }}</p>
                                    <p class="about-team-member__desc">{{ $employee->profession }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if (setting('employees.description'))
                    <div class="default-description">
                        {{ setting('employees.description') }}
                    </div>
                @endif

                <?php $documents = Information::whereCaption('documents')->first(); ?>

                @if ($documents && count($documents->childs) > 0)
                    <div class="documents-wrapper">
                        <h2 class="documents-wrapper__title">Документы</h2>

                        <div class="documents-list">
                            @foreach($documents->childs as $document)
                                @include('informations._document')
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>


            @if (count(setting('advantages')) > 0)
            <div class="my-grid-right">
                <div class="about__statistics" id="statistics">
                    @foreach(setting('advantages') as $advantage)
                    <div class="about-indicator">
                        <p class="about-indicator__num">{{ $advantage['counter'] }}</p>
                        <p class="about-indicator__label">{{ $advantage['title'] }}</p>
                        <p class="about-indicator__desc">{{ $advantage['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif


        </div>
    </div>

    <div class="container about-appeal-container">
        <div class="my-grid">
            <div class="my-grid-left">
                <div class="about-appeal">
                    <div class="about-appeal__content">
                        <p class="about-appeal__title">Сделай благотворительность образом жизни!</p>
                        <p class="about-appeal__desc">Участвуй в благом вместе с нами</p>
                        <div class="about-appeal__btns">
                            <a href="{{ route('want.help') }}" class="about-appeal__to-help">
                                <img src="/images/site/g-heart.svg" alt="heart">
                                <span>Сделать пожертвование</span>
                            </a>
                            <a href="{{ route('want.help') }}" class="about-appeal__volunteer">
                                <span>Стать волонтером</span>
                                <img src="/images/site/b-circle-arrow.svg" alt="heart">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
