<?php // --- education/index.php (Corrected and Final Version) ---




    // --- Page-Specific Variables ---
    $page_title = "Education & Certifications - Michael Ragsdale"; 
    $body_class = "page-education has-sidebar"; 
    $page_description = "A summary of Michael Ragsdale's formal education, degrees, and professional certifications.";

    // 1. Open the document
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';

    // --- Load data for the page ---
    $education = json_decode(file_get_contents(__DIR__ . '/../assets/json/education.json'), true) ?? [];
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
        <?php if (!empty($education)): ?>
            <?php foreach ($education as $edu_item): ?>
                <li class="history-item is-default" data-category="<?php echo htmlspecialchars($edu_item['categories']); ?>">

                    <div class="history-item__period"><?php echo htmlspecialchars($edu_item['period']); ?></div>

                    <div class="history-item__content">
                        <div class="history-item__header">
                            <img class="history-item__logo" src="/<?php echo htmlspecialchars($edu_item['logo']); ?>" alt="<?php echo htmlspecialchars($edu_item['institution']); ?> logo">
                            <div class="history-item__header-text">
                                <h3 class="history-item__title"><?php echo htmlspecialchars($edu_item['institution']); ?></h3>
                                <div class="history-item__subtitle"><?php echo htmlspecialchars($edu_item['location']); ?></div>
                            </div>
                        </div>

                        <div class="history-item__tags">
                            <?php 
                                $tags = array_filter(explode(' ', $edu_item['categories']));
                                if (!empty($tags)):
                                    foreach ($tags as $tag):
                                        $tag_text = htmlspecialchars(ucwords(str_replace('-', ' ', $tag)));
                            ?>
                                <span class="tag tag-<?php echo htmlspecialchars($tag); ?>"><?php echo $tag_text; ?></span>
                            <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>

                        <ul class="role-list">
                            <?php foreach ($edu_item['roles'] as $role): ?>
                                <li class="role-item">
                                    <h4 class="role-title"><?php echo htmlspecialchars($role['title']); ?></h4>
                                    <div class="role-period"><?php echo htmlspecialchars($role['period']); ?></div>

                                    <?php // This is the logic that correctly shows IT or CS descriptions ?>
                                    <?php if(!empty($role['description'])): ?>
                                        <ul class="role-description resume-view-it">
                                            <?php foreach (($role['description']['it'] ?? []) as $bullet): ?>
                                                <li><?php echo htmlspecialchars($bullet); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <ul class="role-description resume-view-cs is-hidden">
                                            <?php foreach (($role['description']['cs'] ?? []) as $bullet): ?>
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