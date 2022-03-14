<li>
    <a href="{{ route('admin.'.lcfirst($module)) }}">
        {!! $settings['icon'] !!}
        <span>{{ $settings['title'] }}</span>

        @if (!is_null($counter))
            <span class="count">{{ $counter }}</span>
        @endif
    </a>
</li>
