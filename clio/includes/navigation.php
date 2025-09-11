<?php
/**
 * /clio/includes/navigation.php
 *
 * This script contains the presentation logic for rendering a navigation menu.
 * It expects a $nav_items array to be available in the scope where it is included.
 */

// Get the current request URI to determine the active page
$current_uri = $_SERVER['REQUEST_URI'];
?>
<nav id="main-menu" class="site-navigation" aria-label="Main Navigation">
    <ul class="nav-menu">
        <?php foreach ($nav_items as $path => $item): ?>
            <?php
                // --- Determine item properties ---
                $has_children = isset($item['sub-menu']);
                $is_external = isset($item['is_external']) && $item['is_external'];
                $icon_to_render = $item['icon'] ?? null;
                $icon_style = (isset($item['icon_brand']) && $item['icon_brand']) ? 'fa-brands' : 'fa-solid';

                // --- Active State Logic for our router ---
                // A link is active if the current URI is an exact match.
                // For the homepage, we check for both '/' and '/index.php' for robustness.
                $is_active = false;
                if (!$is_external) {
                    if ($path === '/') {
                        if ($current_uri === '/' || $current_uri === '/index.php') $is_active = true;
                    } else {
                        // Check if the current URI starts with the link's path
                        if (str_starts_with($current_uri, $path)) $is_active = true;
                    }
                }
            ?>
            <li class="nav-item <?php if ($has_children) echo 'has-children'; ?> <?php if ($is_active) echo 'active'; ?>">
                <a href="<?php echo htmlspecialchars($path); ?>" class="nav-link" <?php if ($is_external) echo 'target="_blank" rel="noopener noreferrer"'; ?>>
                    
                    <?php if ($icon_to_render): ?>
                        <i class="<?php echo $icon_style; ?> fa-fw fa-<?php echo htmlspecialchars($icon_to_render); ?>" aria-hidden="true"></i>
                    <?php endif; ?>

                    <span><?php echo htmlspecialchars($item['text']); ?></span>
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
                                $sub_icon_style = (isset($sub_item['icon_brand']) && $sub_item['icon_brand']) ? 'fa-brands' : 'fa-solid';
                            ?>
                            <li class="nav-item sub-menu-item">
                                <a href="<?php echo htmlspecialchars($sub_path); ?>" class="nav-link sub-menu-link" <?php if ($sub_is_external) echo 'target="_blank" rel="noopener noreferrer"'; ?>>
                                    <?php if ($sub_icon_to_render): ?>
                                        <i class="<?php echo $sub_icon_style; ?> fa-fw fa-<?php echo htmlspecialchars($sub_icon_to_render); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <span><?php echo htmlspecialchars($sub_item['text']); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
