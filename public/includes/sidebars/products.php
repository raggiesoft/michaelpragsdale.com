<?php // --- includes/sidebars/products.php ---

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

$products = [
    ['name' => 'Product Alpha', 'url' => '/products/product-a/'],
    ['name' => 'Project Beta', 'url' => '/products/product-b/'],
    ['name' => 'Service Gamma', 'url' => '/products/product-c/']
];
?>
<aside class="site-sidebar">
    <div class="sidebar-inner">
        <div class="widget">
            <h2 class="widget-title">All Products</h2>
            <nav class="widget-nav" aria-label="Products">
                <ul>
                    <?php foreach ($products as $product): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($product['url']); ?>">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</aside>