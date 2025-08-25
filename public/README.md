# Portfolio Website - michaelpragsdale.com

This is the source code for my personal portfolio website, built from the ground up. The project showcases my skills in modern, accessible, and data-driven web development.

[**View the Live Site**](https://michaelpragsdale.com/)

---

## Key Features

* **Custom PHP Backend:** Built with a modular, include-based templating system.
* **Modern SCSS:** A mobile-first component library with CSS Custom Properties for robust theming (including a "Frutiger Aero" theme) and dark mode support.
* **Data-Driven Content:** Pages like the interactive résumé and employment history are powered by external JSON files.
* **High Accessibility Standards:** Built with a WCAG AAA goal, featuring ARIA labels, semantic HTML, and high-contrast, themeable design tokens.
* **Interactive Components:** Features client-side interactivity built with vanilla JavaScript, including a filterable history list and a multi-step contact form.
* **Secure Admin Area:** A password-protected dashboard for adding new employment data without editing code.

## Tech Stack

* **Backend:** PHP
* **Frontend:** SCSS, Vanilla JavaScript (ES6+), HTML5
* **Dependencies:** Sass (via npm), Parsedown & YAML Frontmatter Parser (via Composer)
* **Tools:** Git, GitHub, VS Code

## Running Locally

1.  Clone the repository.
2.  Install front-end dependencies: `npm install`
3.  Run the development watcher: `npm run watch`
4.  Install back-end dependencies: `composer install`
5.  Run on a local PHP server.