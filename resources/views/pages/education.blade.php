{{-- resources/views/pages/education.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header">
            <h1>Education & Certifications</h1>
            <p class="lead">My academic background and relevant credentials.</p>
        </header>

        <section class="history-section">
            <ul class="history-list">
                @forelse ($education_items as $item)
                    <li class="history-item is-default" data-category="{{ $item->categories }}">

                        <div class="history-item__period">{{ $item->period }}</div>

                        <div class="history-item__content">
                            <div class="history-item__header">
                                <img class="history-item__logo" src="{{ asset($item->logo) }}" alt="{{ $item->institution }} logo">
                                <div class="history-item__header-text">
                                    <h2 class="history-item__title">{{ $item->institution }}</h2>
                                    <div class="history-item__subtitle">{{ $item->location }}</div>
                                </div>
                            </div>

                            <div class="history-item__tags">
                                @php
                                    // Convert the category string into an array of slugs
                                    $tags = array_filter(explode(' ', $item->categories));
                                @endphp
                                @if (!empty($tags))
                                    {{-- Loop through and display each one as a styled tag pill --}}
                                    @foreach ($tags as $tag)
                                        <span class="tag tag-{{ $tag }}">{{ ucwords(str_replace('-', ' ', $tag)) }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <ul class="role-list">
                                @foreach ($item->roles as $role)
                                    <li class="role-item">
                                        <h3 class="role-title">{{ $role['title'] }}</h3>
                                        @if (!empty($role['period']))
                                            <div class="role-period">{{ $role['period'] }}</div>
                                        @endif
                                        @if(!empty($role['description']))
                                            <ul class="role-description">
                                                @php
                                                    // Default to the 'it' description but fall back to 'cs' if 'it' doesn't exist.
                                                    $description_to_show = $role['description']['it'] ?? $role['description']['cs'] ?? [];
                                                @endphp
                                                @foreach ($description_to_show as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @empty
                    <p>There is no education history to display at this time.</p>
                @endforelse
            </ul>
        </section>
    </div>
@endsection
