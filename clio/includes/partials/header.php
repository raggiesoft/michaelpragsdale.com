<?php
/**
 * /clio/partials/header.php
 *
 * The site-wide header component. It includes the site branding (logo),
 * the main page title (H1), and the primary navigation.
 *
 * @copyright Copyright (c) 2025 Michael Ragsdale
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

// Define which menu data file to load (can be overridden by a page)
$menu_to_load = $menu_to_load ?? 'main-menu.php';

// Load the menu data from its correct location
require_once __DIR__ . '/../includes/menus/' . $menu_to_load;
?>
<header class="site-header">
    <div class="header-content container">

        <div class="site-branding">
            <a href="/" rel="home" aria-label="Michael Ragsdale - Home">
                <?php require_once __DIR__ . '/logo.php'; // Your encapsulated SVG logo ?>
                <span class="visually-hidden">Michael Ragsdale - Home</span>
            </a>
        </div>

        <?php // The centered H1 for the page title, populated by the router ?>
        <h1 class="site-title-header"><?php echo htmlspecialchars($page_title ?? 'Welcome'); ?></h1>

        <?php // This wrapper holds all the right-aligned actions ?>
        <div class="header-actions">
            <?php
            // Include the navigation rendering logic
            require_once __DIR__ . '/../includes/navigation.php';
            ?>
            <button class="mobile-nav-toggle" id="mobile-nav-toggle" aria-controls="main-menu" aria-expanded="false" type="button" aria-label="Toggle Navigation">
                <span class="hamburger-icon"><i class="fa-solid fa-bars fa-fw"></i></span>
            </button>
        </div>
        
    </div>
</header>

