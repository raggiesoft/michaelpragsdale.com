div class="button-group">
    @foreach ($nav_items as $url => $button)
        <a href="{{ url($url) }}" class="button button-outline-secondary">
            @if (!empty($button['icon']))
                <i class="fa-duotone fa-fw fa-{{ $button['icon'] }}"></i>
            @endif
            <span>{{ $button['text'] }}</span>
        </a>
    @endforeach
</div>
