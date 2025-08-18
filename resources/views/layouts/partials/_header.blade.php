<?php
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
?>
<header class="site-header">
    <div class="header-content container">

        <div class="site-branding">
            <a href="/" rel="home" aria-label="RaggieSoft - Home">
                <x-site-logo />
               <span class="visually-hidden">Michael Ragsdale - Home</span>
            </a>
        </div>

        <?php // The centered H1 for the page title. ?>
        <h1 class="site-title-header"><?php echo $page_title; ?></h1>

        <?php // This wrapper holds all the right-aligned actions. ?>
        <div class="header-actions">
             <x-main-menu />
            <button class="mobile-nav-toggle" aria-controls="site-navigation" aria-expanded="false" type="button" aria-label="Toggle Navigation">
                <span class="hamburger-icon"><i class="fa-duotone fa-bars fa-fw"></i></span>
            </button>
        </div>

    </div>
</header>
