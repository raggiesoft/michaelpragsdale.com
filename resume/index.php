<?php // --- resume/index.php (Updated for Dynamic Views) ---
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

    $page_title = "Interactive Resume - Michael Ragsdale"; 
    $body_class = "page-resume full-width";
    $page_description = "The interactive resume of Michael Ragsdale, with views tailored for both Information Technology and Customer Service roles.";
    $page_script = "employment-filter resume-toggler"; 

    include __DIR__ . '/../includes/document-open.php';
    include __DIR__ . '/../includes/header.php';

    $jobs = json_decode(file_get_contents(__DIR__ . '/../assets/json/employment.json'), true) ?? [];
    $education = json_decode(file_get_contents(__DIR__ . '/../assets/json/education.json'), true) ?? [];
?>

<main class="site-content" id="content">
    <div class="container">
        <?php // --- NEW: Résumé Contact Info Header --- ?>
        <section class="resume-contact-info">
            <h1 class="resume-name">Michael Ragsdale</h1>
            <ul class="contact-links">
                <li><i class="fa-duotone fa-location-dot fa-fw"></i> Norfolk, VA (Open to Remote in VA)</li>
                <!--<li><a href="/contact/"><i class="fa-duotone fa-calendar-days fa-fw"></i> Schedule Interview</a></li>-->
                <li><a href="https://www.linkedin.com/in/michael-ragsdale-raggiesoft/" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin fa-fw"></i> LinkedIn</a></li>
                <li><a href="https://github.com/raggiesoft" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-github fa-fw"></i> GitHub</a></li>
            </ul>
        </section>

        <header class="page-header">
            <?php // We changed the H1 to be the name, so this can be an H2 or removed ?>
            <h2>Interactive Résumé</h2>
            <p class="lead">An overview of my professional background. Use the view toggles and filters to tailor the content.</p>
        </header>
        
        <section class="resume-section download-links">
            <div class="download-group">
                <h3 class="download-title">Information Technology Focus</h3>
                <div class="download-buttons">
                    <a href="https://michaelpragsdale.com/resume/mragsdale-info-tech.pdf" class="button button-primary" target="_blank" rel="noopener">
                        <i class="fa-duotone fa-file-pdf fa-fw"></i> Download PDF
                    </a>
                    <a href="https://michaelpragsdale.com/resume/mragsdale-info-tech.docx" class="button button-outline-secondary" target="_blank" rel="noopener">
                        <i class="fa-duotone fa-file-word fa-fw"></i> Download DOCX
                    </a>
                </div>
            </div>
            <div class="download-group">
                <h3 class="download-title">Customer Service Focus</h3>
                <div class="download-buttons">
                    <a href="https://michaelpragsdale.com/resume/mragsdale-customer-service.pdf" class="button button-primary" target="_blank" rel="noopener">
                        <i class="fa-duotone fa-file-pdf fa-fw"></i> Download PDF
                    </a>
                    <a href="https://michaelpragsdale.com/resume/mragsdale-customer-service.docx" class="button button-outline-secondary" target="_blank" rel="noopener">
                        <i class="fa-duotone fa-file-word fa-fw"></i> Download DOCX
                    </a>
                </div>
            </div>
        </section>

        <div class="view-toggle filter-tabs">
            <span>View:</span>
            <button class="button active" data-view="it">Information Technology</button>
            <button class="button" data-view="cs">Customer Service</button>
        </div>

        <?php // --- Professional Summary (Will be shown/hidden by CSS) --- ?>
        <section class="resume-section resume-view-it">
            <h2>Professional Summary</h2>
            <p>A versatile professional with a proven background in customer-facing roles, team leadership, and operational management. Actively building on a practical foundation in web development and technical problem-solving while pursuing degrees in Information Technology and Leadership. Eager to apply a unique blend of strong communication skills and technical aptitude to an entry-level IT role.</p>
        </section>
        <section class="resume-section resume-view-cs is-hidden">
            <h2>Professional Summary</h2>
            <p>A versatile professional with a proven background in customer-facing roles, team leadership, and operational management. Actively building on a practical foundation in web development and technical problem-solving while pursuing degrees in Information Technology and Leadership. Eager to apply a unique blend of strong communication skills and technical aptitude to a customer service or entry-level IT role.</p>
        </section>

        <?php // --- Skills vs Core Competencies --- ?>
        <section class="resume-section resume-view-it">
            <h2>Technical Skills</h2>
            <div class="skills-list">
                <div class="skill-category">
                    <h3>Technical</h3>
                    <ul><li>PHP, HTML, CSS, JavaScript, Bootstrap, SQL (MariaDB), REST APIs, Unix/Linux, WCAG, ARIA, Section 508, Deque axe, InstallAware, Inno Setup, NSIS.</li></ul>
                </div>
                <div class="skill-category">
                    <h3>Professional</h3>
                    <ul><li>Team Supervision, Customer Service, Front-Desk Operations, Peer Guidance, Problem-Solving, Communication.</li></ul>
                </div>
            </div>
        </section>
        <section class="resume-section resume-view-cs is-hidden">
            <h2>Core Competencies</h2>
            <div class="skills-list">
                <div class="skill-category">
                    <h3>Customer Service & Leadership</h3>
                    <ul><li>Team Supervision, Front-Desk Operations, De-escalation & Conflict Resolution, Customer-Centric Problem Solving, Peer Guidance & Training, Cash Handling & Closing Reports.</li></ul>
                </div>
                <div class="skill-category">
                    <h3>Communication & Administration</h3>
                    <ul><li>Interpersonal Communication, Document Creation & Management (Google Drive), Administrative Support, Database Management (ActiveNet).</li></ul>
                </div>
                 <div class="skill-category">
                    <h3>Technical Acumen</h3>
                    <ul><li>Proficient with Customer Relationship Management (CRM) systems, Learning Management Systems (LMS), and knowledgeable in web accessibility standards (WCAG/Section 508) for creating user-friendly documents.</li></ul>
                </div>
            </div>
        </section>

        <?php // --- Projects (Only shown in IT view) --- ?>
        <section class="resume-section resume-view-it">
            <h2>Technical Projects</h2>
            <div class="row" style="--grid-gutter-y: var(--spacing-lg);">
                <?php // --- Project 1: This Portfolio Website --- ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Custom Portfolio Website (This Site)</h3>
                    <p class="card-text">A fully responsive, accessible, and themeable portfolio website built from scratch to showcase my skills in modern web development practices.</p>
                    <ul class="project-tech-list">
                        <li><span class="tag">PHP</span></li>
                        <li><span class="tag">SCSS</span></li>
                        <li><span class="tag">JavaScript (ES6+)</span></li>
                        <li><span class="tag">HTML5</span></li>
                        <li><span class="tag">WCAG</span></li>
                        <li><span class="tag">Mobile-First</span></li>
                        <li><span class="tag">JSON</span></li>
                    </ul>
                    <a href="https://github.com/raggiesoft/michaelpragsdale.com" class="button button-outline-secondary" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-github fa-fw"></i> View on GitHub
                    </a>
                </div>
            </div>
        </div>
            </div>
        </section>

        <?php // --- Employment (Dynamically swaps descriptions) --- ?>
        <section class="resume-section" id="resume-employment">
            <h2>Professional Experience</h2>
            <ul class="history-list" id="employment-list">
                 <?php foreach ($jobs as $job): ?>
                    <li class="history-item is-default" data-category="<?php echo htmlspecialchars($job['categories']); ?>">
                        <div class="history-item__period"><?php echo $job['period']; ?></div>
                        <div class="history-item__content">
                            <div class="history-item__header">
                                <img class="history-item__logo" src="/<?php echo htmlspecialchars($job['logo']); ?>" alt="<?php echo htmlspecialchars($job['company']); ?> logo">
                                <div class="history-item__header-text">
                                    <h3 class="history-item__title"><?php echo $job['company']; ?></h3>
                                    <div class="history-item__subtitle"><?php echo $job['location']; ?></div>
                                </div>
                            </div>
                            <?php foreach ($job['roles'] as $role): ?>
                                <div class="role-list">
                                    <div class="role-item">
                                        <h4 class="role-title"><?php echo $role['title']; ?></h4>
                                        <div class="role-period"><?php echo $role['period']; ?></div>

                                        <?php // IT Description (visible by default) ?>
                                        <ul class="role-description resume-view-it">
                                            <?php foreach ($role['description']['it'] as $bullet): ?>
                                                <li><?php echo $bullet; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php // CS Description (hidden by default) ?>
                                        <ul class="role-description resume-view-cs is-hidden">
                                            <?php foreach ($role['description']['cs'] as $bullet): ?>
                                                <li><?php echo $bullet; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <?php // --- Education (Same for both views) --- ?>
        <section id="resume-education" class="resume-section">
            <h2>Education & Certifications</h2>
            <?php /* Your education loop goes here */ ?>
        </section>

    </div>
</main>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>