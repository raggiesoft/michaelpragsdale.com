<?php // --- includes/navigation/main-menu.php ---

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
        '/about-me/'    => [
            'text' => 'About',
            'icon' => 'user',
            'sub-menu' => [
                '/education/'  => 'Education',
                '/employment/' => 'Employment'
            ]
        ],
        '/contact/'     => [
            'text' => 'Contact',
            'icon' => 'calendar-days'
        ],
        'https://www.linkedin.com/in/michael-ragsdale-raggiesoft/' => [
            'text'       => 'LinkedIn',
            'icon'       => 'linkedin',
            'icon_brand' => true, // Use fa-brands style for this icon
            'is_external'=> true  // Mark as an external link
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
                
                // --- Icon Logic ---
                $icon_to_render = $item['icon'] ?? null;
                $icon_style = (isset($item['icon_brand']) && $item['icon_brand']) ? 'fa-brands' : 'fa-duotone';
                
                // --- Active State Logic (only for internal links) ---
                $is_active = false;
                if (!$is_external) {
                    // Handle special case for home page
                    if ($path === '/') {
                        if ($current_uri === '/' || $current_uri === '/index.php') $is_active = true;
                    } else {
                        // Check if the current URL path starts with the link's path
                        $link_root = str_replace('.php', '', $path);
                        if (str_starts_with($current_uri, $link_root)) $is_active = true;
                    }
                }
            ?>
            <li class="nav-item <?php if ($has_children) echo 'has-children'; ?> <?php if ($is_active) echo 'active'; ?>">
                <a href="<?php echo $path; ?>" class="nav-link">
                    
                    <?php if ($icon_to_render): // Render icon if one is specified ?>
                        <i class="<?php echo $icon_style; ?> fa-fw fa-<?php echo $icon_to_render; ?>" aria-hidden="true"></i>
                    <?php endif; ?>

                    <span><?php echo $item['text']; ?></span>
                    <?php // The CSS pseudo-element will automatically add the external link icon if needed ?>
                </a>
                
                <?php if ($has_children): ?>
                    <ul class="sub-menu">
                        <?php foreach ($item['sub-menu'] as $sub_path => $sub_text): ?>
                            <li class="nav-item sub-menu-item">
                                <a href="<?php echo $sub_path; ?>" class="nav-link sub-menu-link"><?php echo $sub_text; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>