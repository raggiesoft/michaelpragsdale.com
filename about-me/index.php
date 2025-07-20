<?php // --- about-me/index.php ---
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
    // --- Page-Specific Variables ---
    $page_title = "About Michael Ragsdale"; 
    $body_class = "page-about has-sidebar"; 
    $page_description = "Learn more about Michael Ragsdale's background, skills, resume, and how to get in touch.";

    // 1. Open the document
    include __DIR__ . '/../includes/document-open.php';

    // 2. Add the site header
    include __DIR__ . '/../includes/header.php';
?>

<div class="site-body-wrapper">

    <?php include __DIR__ . '/../includes/sidebars/about.php'; ?>

    <main class="site-content" id="content">
        <div class="container"> 
            <header class="page-header">
                <h1>About Me</h1>
                <p class="lead">An overview of my professional background and resources for recruiters.</p>
            </header>

            <section class="about-intro resume-section">
                <div class="about-intro__image">
                    <img src="/assets/images/michael-ragsdale-profile.jpg" alt="A professional headshot of Michael Ragsdale.">
                </div>
                <div class="about-intro__text">
                    <h2>Developer & Problem-Solver</h2>
                    <p>Hello! I'm Michael Ragsdale, a web developer based in Norfolk, Virginia. My passion lies in building practical, user-friendly digital tools from the ground up. I enjoy the entire process, from structuring back-end logic with PHP to creating accessible, responsive front-end experiences with modern SCSS and JavaScript.</p>
                    <p>This portfolio is a living document of my journey. Below, you'll find links to my interactive résumé, detailed work history, and other resources. Thank you for visiting.</p>
                </div>
            </section>
            <?php // In about-me/index.php, after the .about-intro section ?>

            <section class="resume-section">
                <h2>My Guiding Principles</h2>
                <div class="principles-list">
                    <div class="principle-item">
                        <i class="fa-duotone fa-universal-access fa-2x"></i>
                        <h3>Accessibility First</h3>
                        <p>I believe the web is for everyone. I prioritize building inclusive interfaces that meet WCAG standards to ensure a great experience for all users.</p>
                    </div>
                    <div class="principle-item">
                        <i class="fa-duotone fa-code-commit fa-2x"></i>
                        <h3>Clean & Maintainable Code</h3>
                        <p>I write code that is not just functional but also readable and well-organized, making it easy for my future self and others to maintain and build upon.</p>
                    </div>
                    <div class="principle-item">
                        <i class="fa-duotone fa-brain-circuit fa-2x"></i>
                        <h3>Lifelong Learning</h3>
                        <p>Technology is always evolving, and so am I. I am constantly exploring new tools and techniques to improve my craft and solve problems more effectively.</p>
                    </div>
                </div>
            </section>

            <div class="row" style="--grid-gutter-y: var(--spacing-lg);">

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-file-lines fa-3x card-icon"></i>
                            <h2 class="card-title h3">Interactive Résumé</h2>
                            <p class="card-text">View my full work history, education, and skills. Filter my experience to find what's most relevant to you.</p>
                            <a href="/resume/" class="button button-primary stretched-link">View Résumé</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-graduation-cap fa-3x card-icon"></i>
                            <h2 class="card-title h3">Education History</h2>
                            <p class="card-text">A summary of my academic background, degrees, and professional certifications in Information Technology and Leadership.</p>
                            <a href="/education/" class="button button-primary stretched-link">View Education</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-calculator fa-3x card-icon"></i>
                            <h2 class="card-title h3">Salary Checker</h2>
                            <p class="card-text">To ensure alignment, use this tool to see if an opportunity's compensation meets my requirements before reaching out.</p>
                            <a href="/about/salary/" class="button button-primary stretched-link">Use Salary Checker</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card card-icon-link">
                        <div class="card-body">
                            <i class="fa-duotone fa-calendar-days fa-3x card-icon"></i>
                            <h2 class="card-title h3">Schedule Interview</h2>
                            <p class="card-text">Ready to talk? Use my Calendly link to directly schedule a time that works for both of us. No back-and-forth emails required.</p>
                            <a href="/contact/" class="button button-primary stretched-link">Schedule Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</div>

<?php
    include __DIR__ . '/../includes/footer.php';
    include __DIR__ . '/../includes/document-close.php';
?>