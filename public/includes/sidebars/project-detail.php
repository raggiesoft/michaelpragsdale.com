<?php // --- includes/sidebars/sidebar-project-detail.php --- ?>
<aside class="site-sidebar">
    <div class="sidebar-inner">

        <?php // This sidebar needs the $project variable to be defined on the page that includes it. ?>
        <?php if (isset($project)): ?>
            <div class="widget">
                <h2 class="widget-title">Project Info</h2>

                <?php 
                    // Use the 'tech_stack' from inside 'details' if it exists, otherwise use the top-level one.
                    $tech_stack = $project['details']['tech_stack'] ?? $project['tech_stack'] ?? [];
                ?>
                <?php if (!empty($tech_stack)): ?>
                    <h3 class="widget-subtitle">Technology Stack</h3>
                    <div class="tech-tags">
                        <?php foreach ($tech_stack as $tech): ?>
                            <span class="tag"><?php echo htmlspecialchars($tech); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($project['details']['compatibility'])): ?>
                    <h3 class="widget-subtitle">Compatibility</h3>
                    <ul class="widget-list">
                        <?php foreach ($project['details']['compatibility'] as $item): ?>
                            <li><?php echo htmlspecialchars($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if (!empty($project['live_url']) || !empty($project['repo_url'])): ?>
                <div class="widget">
                    <h2 class="widget-title">Project Links</h2>
                    <ul class="widget-list">
                        <?php if (!empty($project['repo_url'])): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($project['repo_url']); ?>">
                                    <i class="fa-brands fa-github fa-fw"></i> View on GitHub
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($project['live_url'])): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($project['live_url']); ?>">
                                    <i class="fa-duotone fa-browser fa-fw"></i> View Live
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</aside>