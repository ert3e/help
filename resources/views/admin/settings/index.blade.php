@extends('layouts.app')

@section('content')

    {{ Form::open(['route' => 'admin.settings.save', 'files' => true]) }}

    <div>
        <!-- Навигация -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#index" aria-controls="index" role="tab" data-toggle="tab">Основные настройки</a></li>
            <li><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a></li>
            <li><a href="#paginations" aria-controls="paginations" role="tab" data-toggle="tab">Пагинация</a></li>
            <li><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Изображения</a></li>
            <li><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">Контакты</a></li>
            <li><a href="#advantages" aria-controls="advantages" role="tab" data-toggle="tab">Статистика (о фонде)</a></li>
            <li><a href="#additional" aria-controls="additional" role="tab" data-toggle="tab">Дополнительно</a></li>
        </ul>
        <!-- Содержимое вкладок -->
        <div class="tab-content">



            <div role="tabpanel" class="tab-pane active" id="index">
                <h3>Основные настройки: </h3>

                <div class="form-group">
                    <label for="title">Название сайта</label>
                    {{ Form::input('text', 'settings[main][title]', setting('main.title'),  ['id' => 'title', 'class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    <label for="description_header_js">JavaScript/Стили (header):</label>
                    {{ Form::textarea('settings[main][header_js]', setting('main.header_js'),  ['id' => 'header_js', 'rows' => 5, 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="description_footer_js">JavaScript/Стили (footer):</label>
                    {{ Form::textarea('settings[main][footer_js]', setting('main.footer_js'),  ['id' => 'footer_js', 'rows' => 5, 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="robots">Robots.txt:</label>
                    {{ Form::textarea('settings[main][robots]', setting('main.robots'),  ['id' => 'robots', 'class' => 'form-control']) }}
                </div>
            </div>



            <div role="tabpanel" class="tab-pane" id="seo">
                <h3>SEO настройки: </h3>

                <div class="form-group">
                    <label for="meta_h1">Заголовок на главной:</label>
                    {{ Form::input('text', 'settings[main][meta_h1]', setting('main.meta_h1'),  ['id' => 'meta_h1', 'class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    <label for="meta_title">Заголовок во вкладке:</label>
                    {{ Form::input('text', 'settings[main][meta_title]', setting('main.meta_title'),  ['id' => 'meta_title', 'class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    <label for="meta_description">Мета описание:</label>
                    {{ Form::input('text', 'settings[main][meta_description]', setting('main.meta_description'),  ['id' => 'meta_description', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Мета ключевые слова:</label>
                    {{ Form::input('text', 'settings[main][meta_keywords]', setting('main.meta_keywords'),  ['id' => 'meta_keywords', 'class' => 'form-control']) }}
                </div>

            </div>




            <div role="tabpanel" class="tab-pane" id="paginations">
                <h3>Пагинация: </h3>

                <div class="form-group">
                    <label for="main_paginate">Количество объектов на странице: </label>
                    {{ Form::input('number', 'settings[main][paginate]', setting('main.paginate'),  ['id' => 'main_paginate', 'class' => 'form-control', 'required' => 'required', 'min' => 1]) }}
                </div>
            </div>




            <div role="tabpanel" class="tab-pane" id="gallery">
                <h3>Изображения: </h3>

                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group images_size">
                            <label for="category_miniature">Размеры (миниатюры) - категории</label>
                            <div class="clearfix">
                                {{ Form::input('number', 'settings[category][miniature]', setting('category.miniature'),  ['id' => 'category_miniature', 'class' => 'form-control gallery_input left', 'required' => 'required']) }}
                                <span class="settings_lineh"> x <span class="images_size_span">{{ setting('category.miniature') }}</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group images_size">
                            <label for="product_miniature">Размеры (миниатюры) - товары </label>
                            <div class="clearfix">
                                {{ Form::input('number', 'settings[product][miniature]', setting('product.miniature'),  ['id' => 'product_miniature', 'class' => 'form-control gallery_input left', 'required' => 'required']) }}
                                <span class="settings_lineh"> x <span class="images_size_span">{{ setting('product.miniature') }}</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group images_size">
                            <label for="filemanager_miniature">Размеры (миниатюры) - файловый менеджер</label>
                            <div class="clearfix">
                                {{ Form::input('number', 'settings[filemanager][miniature]', setting('filemanager.miniature'),  ['id' => 'filemanager_miniature', 'class' => 'form-control gallery_input left', 'required' => 'required']) }}
                                <span class="settings_lineh"> x <span class="images_size_span">{{ setting('filemanager.miniature') }}</span></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group images_size">
                            <label for="photos_miniature">Размеры (миниатюры) - галерея</label>
                            <div class="clearfix">
                                {{ Form::input('number', 'settings[photos][miniature]', setting('photos.miniature'),  ['id' => 'photos_miniature', 'class' => 'form-control gallery_input left', 'required' => 'required']) }}
                                <span class="settings_lineh"> x <span class="images_size_span">{{ setting('photos.miniature') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h3>Качество изображений: (от 50 до 100)</h3>
                    <div>
                        <div class="clearfix">
                            {{ Form::input('number', 'settings[images][quality]', setting('images.quality'),  ['id' => 'images_quality', 'class' => 'form-control gallery_input left', 'required' => 'required']) }}
                            <span class="settings_lineh"> %</span>
                        </div>
                    </div>
                </div>
            </div>




            <div role="tabpanel" class="tab-pane" id="contacts">
                <h3>Контактная информация: </h3>


                <div class="form-group">
                    <label for="address">Адреc:</label>
                    {{ Form::input('text', 'settings[contacts][address]', setting('contacts.address'),  ['id' => 'address', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    {{ Form::input('text', 'settings[contacts][email]', setting('contacts.email'),  ['id' => 'email', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="telephone">Номер телефона:</label>
                    {{ Form::input('text', 'settings[contacts][telephone]', setting('contacts.telephone'),  ['id' => 'telephone', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="telephone_2">Номер телефона 2:</label>
                    {{ Form::input('text', 'settings[contacts][telephone_2]', setting('contacts.telephone_2'),  ['id' => 'telephone_2', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="telephone_3">Номер телефона 3:</label>
                    {{ Form::input('text', 'settings[contacts][telephone_3]', setting('contacts.telephone_3'),  ['id' => 'telephone_3', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="map_code">Код интерактивной карты (iframe):</label>
                    {{ Form::input('text', 'settings[contacts][map_code]', setting('contacts.map_code'),  ['id' => 'map_code', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="email">Контактный e-mail:</label>
                    {{ Form::input('email', 'settings[contacts][email]', setting('contacts.email'),  ['id' => 'email', 'class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    <label for="email_alerts">E-mail для уведомлений:</label>
                    {{ Form::input('email', 'settings[contacts][email_alerts]', setting('contacts.email_alerts'),  ['id' => 'email_alerts', 'class' => 'form-control', 'required' => 'required']) }}
                </div>

                <h3>Ссылки на соц. сети: </h3>

                <div class="form-group">
                    <label for="social_instagram">Instagram:</label>
                    {{ Form::input('text', 'settings[social][instagram]', setting('social.instagram'),  ['id' => 'social_instagram', 'class' => 'form-control']) }}
                </div>

            </div>

            <div role="tabpanel" class="tab-pane" id="advantages">
                <h3>О фонде (статистика): </h3>
                <hr>
                @for($i = 1; $i <= 4; $i++)
                    <h4>№{{ $i }}</h4>

                    <div class="form-group">
                        <label for="advantages_counter_{{ $i }}">Кол-во</label>
                        {{ Form::input('text', 'settings[advantages]['.$i.'][counter]', setting('advantages.'.$i.'.counter'),  ['id' => 'advantages_counter_'.$i, 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label for="advantages_title_{{ $i }}">Заголовок</label>
                        {{ Form::input('text', 'settings[advantages]['.$i.'][title]', setting('advantages.'.$i.'.title'),  ['id' => 'advantages_title_'.$i, 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label for="advantages_description_{{ $i }}">Описание</label>
                        {{ Form::textarea('settings[advantages]['.$i.'][description]', setting('advantages.'.$i.'.description'),  ['id' => 'advantages_description_'.$i, 'class' => 'form-control', 'rows' => 3]) }}
                    </div>

                @endfor
            </div>

            <div role="tabpanel" class="tab-pane" id="additional">

                <h3>Главная страница: </h3>

                <div class="form-group">
                    <label for="statistic_donation_all">Собранная сумма за все время</label>
                    {{ Form::input('text', 'settings[statistic][donation_all]', setting('statistic.donation_all'), ['id' => 'statistic_donation_all', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="statistic_donation_year">Собранная сумма за текущий год</label>
                    {{ Form::input('text', 'settings[statistic][donation_year]', setting('statistic.donation_year'), ['id' => 'statistic_donation_year', 'class' => 'form-control']) }}
                </div>

                <h3>Мне нужна помощь: </h3>

                <div class="form-group">
                    <label for="need_help_description">Текст на странице</label>
                    {{ Form::textarea('settings[need-help][description]', setting('need-help.description'), ['id' => 'need_help_description', 'class' => 'form-control', 'rows' => 3]) }}
                </div>

                <div class="form-group">
                    <label for="filling_form">Бланк заявления</label>

                    <?php $file = glob('storage/files/need-help/filling-form/*.*'); ?>
                    @if (isset($file[0]))
                        <a href="/{{ $file[0] }}" class="badge badge-primary">загруженный файл</a>
                    @endif

                    {{ Form::file('files[need-help][filling-form]', ['id' => 'filling_form', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label for="need_documents">Необходимые документы</label>

                    <?php $file = glob('storage/files/need-help/need-documents/*.*'); ?>
                    @if (isset($file[0]))
                        <a href="/{{ $file[0] }}" class="badge badge-primary">загруженный файл</a>
                    @endif

                    {{ Form::file('files[need-help][need-documents]', ['id' => 'need_documents', 'class' => 'form-control']) }}
                </div>

            </div>

        </div>
    </div>



    <div class="form-group">
        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
        <a href="{{ route('admin.main') }}" class="btn btn-warning">Отмена</a>
    </div>

    {{ Form::close() }}


@endsection


@section('footer_js')
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
