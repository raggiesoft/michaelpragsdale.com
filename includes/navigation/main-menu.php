<?php // --- includes/navigation/main-menu.php (Complete & Final Version) ---

    $current_uri = $_SERVER['REQUEST_URI'];

    // This is the central data source for your main navigation menu.
    $nav_items = [
        '/'             => [
            'text' => 'Home',
            'icon' => 'house'
        ],
        '/resume/'      => [
            'text' => 'Résumé',
            'icon' => 'file-lines'
        ],
        '/projects/'    => [
            'text' => 'Projects',
            'icon' => 'laptop-code'
        ],
        '/about-me/'    => [
            'text' => 'About',
            'icon' => 'user',
            'sub-menu' => [
                '/education/'       => ['text' => 'Education'],
                '/employment/'      => ['text' => 'Employment'],
                'separator-about'   => '---', // This will render as a separator
                '/about-me/salary/' => ['text' => 'Salary Checker']
            ]
        ],
        '/contact/'     => [
            'text' => 'Contact',
            'icon' => 'envelope',
            'sub-menu' => [
                'https://www.linkedin.com/in/michael-ragsdale-raggiesoft/' => [
                    'text'       => 'LinkedIn',
                    'icon'       => 'linkedin',
                    'icon_brand' => true,
                    'is_external'=> true
                ],
                'https://github.com/raggiesoft' => [
                    'text'       => 'GitHub',
                    'icon'       => 'github',
                    'icon_brand' => true,
                    'is_external'=> true
                ]
            ]
        ]
    ];

?>
<nav class="site-navigation" aria-label="Main Navigation">
    <ul class="nav-menu">
        <?php foreach ($nav_items as $path => $item): ?>
            <?php
                // --- Determine item properties ---
                $has_children = isset($item['sub-menu']);
                $is_external = isset($item['is_external']) && $item['is_external'];
                $icon_to_render = $item['icon'] ?? null;
                $icon_style = (isset($item['icon_brand']) && $item['icon_brand']) ? 'fa-brands' : 'fa-duotone';
                
                // --- Active State Logic (only for internal links) ---
                $is_active = false;
                if (!$is_external) {
                    if ($path === '/') {
                        if ($current_uri === '/' || $current_uri === '/index.php') $is_active = true;
                    } else {
                        $link_root = str_replace('.php', '', $path);
                        if (str_starts_with($current_uri, $link_root)) $is_active = true;
                    }
                }
            ?>
            <li class="nav-item <?php if ($has_children) echo 'has-children'; ?> <?php if ($is_active) echo 'active'; ?>">
                <a href="<?php echo $path; ?>" class="nav-link" <?php if ($is_external) echo 'target="_blank" rel="noopener noreferrer"'; ?>>
                    
                    <?php if ($icon_to_render): ?>
                        <i class="<?php echo $icon_style; ?> fa-fw fa-<?php echo $icon_to_render; ?>" aria-hidden="true"></i>
                    <?php endif; ?>

                    <span><?php echo $item['text']; ?></span>
                </a>
                
                <?php if ($has_children): ?>
                    <ul class="sub-menu">
                        <?php foreach ($item['sub-menu'] as $sub_path => $sub_item): ?>
                            <?php
                                // Check if the item is a separator
                                if ($sub_item === '---') {
                                    echo '<li class="menu-separator" role="separator"></li>';
                                    continue; // Skip to the next item in the loop
                                }

                                // Determine sub-item properties
                                $sub_is_external = isset($sub_item['is_external']) && $sub_item['is_external'];
                                $sub_icon_to_render = $sub_item['icon'] ?? null;
                                $sub_icon_style = (isset($sub_item['icon_brand']) && $sub_item['icon_brand']) ? 'fa-brands' : 'fa-duotone';
                            ?>
                            <li class="nav-item sub-menu-item">
                                <a href="<?php echo $sub_path; ?>" class="nav-link sub-menu-link" <?php if ($sub_is_external) echo 'target="_blank" rel="noopener noreferrer"'; ?>>
                                    <?php if ($sub_icon_to_render): ?>
                                        <i class="<?php echo $sub_icon_style; ?> fa-fw fa-<?php echo $sub_icon_to_render; ?>" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <span><?php echo $sub_item['text']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>