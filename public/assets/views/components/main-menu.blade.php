<nav class="site-navigation" aria-label="Main Navigation">
    <ul class="nav-menu">
        @foreach ($nav_items as $path => $item)
            @php
                $has_children = !empty($item['sub-menu']);
                $is_external = !empty($item['is_external']);
                $icon_to_render = $item['icon'] ?? null;
                $icon_style = !empty($item['icon_brand']) ? 'fa-brands' : 'fa-duotone';
                $is_active = false;
                if (!$is_external) {
                    if ($path === '/') { $is_active = request()->is('/');
                    } else { $is_active = request()->is(trim($path, '/') . '*'); }
                }
            @endphp
            <li class="nav-item @if($has_children) has-children @endif @if($is_active) active @endif">
                <a href="{{ $is_external ? $path : url($path) }}" class="nav-link" @if($is_external) target="_blank" rel="noopener noreferrer" @endif>
                    @if ($icon_to_render)
                        <i class="{{ $icon_style }} fa-fw fa-{{ $icon_to_render }}" aria-hidden="true"></i>
                    @endif
                    <span>{{ $item['text'] }}</span>
                </a>
                @if ($has_children)
                    <ul class="sub-menu">
                        @foreach ($item['sub-menu'] as $sub_path => $sub_item)
                            @if (is_string($sub_item) && $sub_item === '---')
                                <li class="menu-separator" role="separator"></li>
                                @continue
                            @endif
                            @php
                                $sub_is_external = !empty($sub_item['is_external']);
                                $sub_icon_to_render = $sub_item['icon'] ?? null;
                                $sub_icon_style = !empty($sub_item['icon_brand']) ? 'fa-brands' : 'fa-duotone';
                            @endphp
                            <li class="nav-item sub-menu-item">
                                <a href="{{ $sub_is_external ? $sub_path : url($sub_path) }}" class="nav-link sub-menu-link" @if($sub_is_external) target="_blank" rel="noopener noreferrer" @endif>
                                    @if ($sub_icon_to_render)
                                        <i class="{{ $sub_icon_style }} fa-fw fa-{{ $sub_icon_to_render }}" aria-hidden="true"></i>
                                    @endif
                                    <span>{{ $sub_item['text'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
