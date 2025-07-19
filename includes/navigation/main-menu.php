<?php // --- includes/navigation/main-menu.php ---
/**
 * My Portfolio Website
 *
 * This file is part of My Portfolio Website.
 *
 * My Portfolio Website is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @copyright Copyright (c) 2025 Michael Ragsdale
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */
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