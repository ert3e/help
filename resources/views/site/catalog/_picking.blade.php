<div class="poor-card">
    <div class="poor-card__top">
        <div class="poor-card__info">
            <a href="{{ route('catalog', $picking->path) }}" class="poor-card__title">{{ $picking->title }}</a>
            <p class="poor-card__desc">{!! output($picking->description, 160) !!}</p>
        </div>
        <a href="{{ route('catalog', $picking->path) }}" class="poor-card__img">
            <img src="{{ $picking->mainImage(400) }}" alt="poor-man">
        </a>
    </div>

    <div class="poor-card__line"></div>

    <div class="poor-card__bottom">
        <div class="poor-card__indicators">
            <div class="poor-card-indicator poor-card-indicator__need">
                <p class="poor-card-indicator__label">Нужно</p>
                <p class="poor-card-indicator__sum">{{ $picking->formattedPrice() }} </p>
            </div>
            <div class="poor-card-indicator poor-card-indicator__collected">
                <p class="poor-card-indicator__label">Собрали</p>
                @if ($picking->paymentsPaid->sum('amount') == 0 && $picking->category_id == Category::TYPE_HELPED)
                    <p class="poor-card-indicator__sum">{{ formattedPrice($picking->price) }}</p>
                @else
                    <p class="poor-card-indicator__sum">{{ formattedPrice($picking->paymentsPaid->sum('amount')) }}</p>
                @endif
            </div>
            @if ($picking->paymentsPaid->sum('amount') == 0 && $picking->category_id == Category::TYPE_HELPED)
                <div class="poor-card-indicator"></div>
            @else
                @if ($agent->isMobile())
                    <a href="#" class="poor-card-indicator__refer">Расскажите о сборе</a>
                @endif
            @endif
        </div>
        <div class="poor-card__panel">
            @if ($picking->paymentsPaid->sum('amount') < $picking->price && $picking->category_id == Category::TYPE_NEEDHELP)
                <a href="{{ route('want.help', ['picking' => $picking->id]) }}" class="poor-card__to-help">
                    <img src="/images/site/heart.svg" alt="помочь">
                    <span>Помочь</span>
                </a>
            @else
                <button class="poor-card__okey">
                    <img src="/images/site/check-circle.svg" alt="завершено">
                    <span>Сбор завершен</span>
                </button>
            @endif
        </div>
    </div>
</div>
