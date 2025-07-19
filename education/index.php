<?php // --- education/index.php ---

    // --- Page-Specific Variables ---
    $page_title = "Education & Certifications - Michael Ragsdale"; 
    $body_class = "page-education has-sidebar"; 
    $page_description = "A summary of Michael Ragsdale's formal education, degrees, and professional certifications.";

    // 1. Open the document
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';

    // --- Load data for the page ---
    $education_items = json_decode(file_get_contents(__DIR__ . '/../assets/json/education.json'), true) ?? [];
?>

<?php // 3. Assemble the main body content ?>
<div class="site-body-wrapper">

    <?php include __DIR__ . '/../includes/sidebars/sidebar-default.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>Education & Certifications</h1>
                <p class="lead">My academic background and relevant credentials.</p>
            </header>

            <section class="history-section">
                <ul class="history-list">
                    <?php if (!empty($education_items)): ?>
                        <?php foreach ($education_items as $item): ?>
                            <li class="history-item is-default" data-category="<?php echo htmlspecialchars($item['categories']); ?>">
                                <div class="history-item__period"><?php echo htmlspecialchars($item['period']); ?></div>
                                <div class="history-item__content">

                                    <div class="history-item__header">
                                        <img class="history-item__logo" src="/<?php echo htmlspecialchars($item['logo']); ?>" alt="<?php echo htmlspecialchars($item['institution']); ?> logo">
                                        <div class="history-item__header-text">
                                            <h2 class="history-item__title"><?php echo htmlspecialchars($item['institution']); ?></h2>
                                            <div class="history-item__subtitle"><?php echo htmlspecialchars($item['location']); ?></div>
                                        </div>
                                    </div>

                                    <div class="history-item__tags">
                                        <?php 
                                            $tags = explode(' ', $item['categories']);
                                            $tag_count = count($tags);
                                            if ($tag_count > 0 && !empty(trim($item['categories']))):
                                                $label = ($tag_count > 1) ? 'Categories:' : 'Category:';
                                                echo '<span class="tags-label">' . $label . '</span>';
                                                $html_tags = [];
                                                foreach ($tags as $tag) {
                                                    $tag_text = htmlspecialchars(ucwords(str_replace('-', ' ', $tag)));
                                                    $html_tags[] = '<span class="tag tag-' . htmlspecialchars($tag) . '">' . $tag_text . '</span>';
                                                }
                                                echo implode(', ', $html_tags);
                                            endif;
                                        ?>
                                    </div>

                                    <ul class="role-list">
                                        <?php foreach ($item['roles'] as $role): ?>
                                            <li class="role-item">
                                                <h3 class="role-title"><?php echo htmlspecialchars($role['title']); ?></h3>
                                                <div class="role-period"><?php echo htmlspecialchars($role['period']); ?></div>
                                                <?php if(!empty($role['description'])): ?>
                                                    <ul class="role-description">
                                                        <?php foreach ($role['description'] as $bullet): ?>
                                                            <li><?php echo htmlspecialchars($bullet); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>There is no education history to display at this time.</p>
                    <?php endif; ?>
                </ul>
            </section>

        </div>
    </main>

</div> <?php // End of .site-body-wrapper ?>

<?php
    // 4. Add the site footer
    include __DIR__ . '/../includes/footer.php';

    // 5. Close the document
    include __DIR__ . '/../includes/document-close.php';
?>