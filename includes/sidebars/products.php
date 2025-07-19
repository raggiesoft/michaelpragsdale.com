<?php // --- includes/sidebars/products.php ---

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