<div class="footer-space"></div>
<footer class="footer">
    <div class="container">
        <div class="footer__panel">
            <div class="footer__logo-block">
                <a href="{{ route('main') }}" class="footer__logo">
                    <img src="/images/site/logo-footer.svg" alt="фонд Азим">
                </a>
                <span class="footer__autor">{{ date('Y') }} © Фонд «Азим»</span>
            </div>


            <nav class="footer-menu">
                @foreach(NavigationBase::where('alias', 'like', 'footer_menu_%')->orderPosition()->get() as $footerMenu)
                    <ul>
                        @foreach($footerMenu->childs as $menuLink)
                            <li><a href="{{ $menuLink->url }}">{{ $menuLink->title }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </nav>
        </div>

        <div class="footer__contacts">
            @if (setting('contacts.telephone'))
                <a href="tel:{{ formattedLinkTelephone(setting('contacts.telephone')) }}" class="footer-contact footer-contact-num">
                    <div class="footer-contact__img">
                        <img src="/images/site/tel.svg" alt="телефон">
                    </div>
                    <span>{{ setting('contacts.telephone') }}</span>
                </a>
            @endif

            @if (setting('contacts.email'))
                <a href="mailto:{{ setting('contacts.email') }}" class="footer-contact">
                    <div class="footer-contact__img">
                        <img src="/images/site/msg.svg" alt="e-mail">
                    </div>
                    <span>{{ setting('contacts.email') }}</span>
                </a>
            @endif

            @if (setting('social.instagram'))
                <a href="{{ setting('social.instagram') }}" class="footer-contact">
                    <div class="footer-contact__img">
                        <img src="/images/site/inst.svg" alt="инстаграм">
                    </div>
                    <span>Инстаграм</span>
                </a>
            @endif
        </div>
    </div>

</footer>
