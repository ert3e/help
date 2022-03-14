<div class="alert-container center-wrap">
    @if (isset($success) && $success)
        <img src="/images/site/success.svg" alt="Успешно">
    @endif
    @if (isset($error) && $error)
        <div class="alert-error">
            <img src="/images/site/close.svg" alt="Ошибка">
        </div>
    @endif
    <div class="alert-title">
        {{ $title }}
        @if (isset($subtitle) && $subtitle)
            <span>{{ $subtitle }}</span>
        @endif
    </div>
    <p class="alert-text">
        {{ $description }}
    </p>

    <a href="{{ route('main') }}" class="btn black">&laquo; На главную</a>
</div>
