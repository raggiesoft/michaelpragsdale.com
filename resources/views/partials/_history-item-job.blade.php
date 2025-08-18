@php
    // Define the helper function if it doesn't exist
    if (!function_exists('get_history_item_priority_class')) {
        function get_history_item_priority_class($categories_string) {
            if (str_contains($categories_string, 'current-employer')) return 'is-current';
            if (str_contains($categories_string, 'volunteer') || str_contains($categories_string, 'internship')) return 'is-highlighted';
            return 'is-default';
        }
    }
    $priority_class = get_history_item_priority_class($job->categories);
@endphp

<li class="history-item {{ $priority_class }}" data-category="{{ $job->categories }}">
    <div class="history-item__period">{{ $job->period }}</div>
    <div class="history-item__content">
        <div class="history-item__header">
            <img class="history-item__logo" src="{{ asset($job->logo) }}" alt="{{ $job->company }} logo">
            <div class="history-item__header-text">
                <h3 class="history-item__title">{{ $job->company }}</h3>
                <div class="history-item__subtitle">{{ $job->location }}</div>
            </div>
        </div>
        <div class="history-item__tags">
            @php $tags = array_filter(explode(' ', $job->categories)); @endphp
            @if (!empty($tags))
                @foreach ($tags as $tag)
                    <span class="tag tag-{{$tag}}">{{ ucwords(str_replace('-', ' ', $tag)) }}</span>
                @endforeach
            @endif
        </div>
        <ul class="role-list">
            @foreach ($job->roles as $role)
                <li class="role-item">
                    <h4 class="role-title">{{ $role['title'] }}</h4>
                    @if (!empty($role['period']))
                        <div class="role-period">{{ $role['period'] }}</div>
                    @endif
                    {{-- On the main employment page, we default to showing the IT description --}}
                    <ul class="role-description">
                        @foreach (($role['description']['it'] ?? []) as $bullet)
                            <li>{{ $bullet }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</li>
