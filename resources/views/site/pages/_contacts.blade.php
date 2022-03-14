<div class="contacts">
    <div class="container">

        <h1 class="page-title">@include('templates.seo.title', ['object' => $model])</h1>

        @if ($model->description)
            <div class="default-description">
                {!! $model->description !!}
            </div>
        @endif

        <div class="contacts__list">

            @if (setting('contacts.address'))
                <div class="contacts-item">
                    <div class="contacts-item__top">
                        <img src="/images/site/contact1.svg" alt="адрес">
                        <p>Адрес</p>
                    </div>
                    <div class="contacts-item__bottom">
                        <p>{{ setting('contacts.address') }}</p>
                    </div>
                </div>
            @endif

            @if (setting('contacts.telephone') || setting('contacts.telephone_2'))
                <div class="contacts-item">
                    <div class="contacts-item__top">
                        <img src="/images/site/contact2.svg" alt="телефон">
                        <p>Телефон</p>
                    </div>
                    <div class="contacts-item__bottom contacts-item__bottom_phones">
                        @if (setting('contacts.telephone'))
                            <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone')) }}">{{ setting('contacts.telephone') }}</a>
                        @endif
                        @if (setting('contacts.telephone_2'))
                            <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone_2')) }}">{{ setting('contacts.telephone_2') }}</a>
                        @endif
                        @if (setting('contacts.telephone_3'))
                            <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone_3')) }}">{{ setting('contacts.telephone_3') }}</a>
                        @endif
                    </div>
                </div>
            @endif

            @if (setting('contacts.email'))
                <div class="contacts-item">
                    <div class="contacts-item__top">
                        <img src="/images/site/contact3.svg" alt="e-mail">
                        <p>E-mail</p>
                    </div>
                    <div class="contacts-item__bottom">
                        <p>{{ setting('contacts.email') }}</p>
                    </div>
                </div>
            @endif

        </div>

        @if (setting('contacts.map_code'))
            <div class="contacts__map">
                {!! setting('contacts.map_code') !!}
            </div>
        @endif

    </div>
</div>
