<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-column footer-about">
                <h3 class="footer-heading">Michael Ragsdale</h3>
                <p>A web developer building accessible, user-friendly, and maintainable applications from the ground up.</p>
                <div class="footer-social">
                    <a href="https://www.linkedin.com/in/michael-ragsdale-raggiesoft/" aria-label="LinkedIn Profile">
                        <i class="fa-brands fa-linkedin fa-fw"></i>
                    </a>
                    <a href="https://github.com/raggiesoft" aria-label="GitHub Profile">
                        <i class="fa-brands fa-github fa-fw"></i>
                    </a>
                </div>
            </div>

            <div class="footer-links-grid">
                <div class="footer-column">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('resume') }}">Résumé</a></li>
                        <li><a href="{{ route('projects.index') }}">Projects</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3 class="footer-heading">Developer</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('api-docs') }}">API Documentation</a></li>
                        <li><a href="https://status.michaelpragsdale.com" target="_blank">Server Status</a></li>
                        <li><a href="https://mail.michaelpragsdale.com" target="_blank">Webmail</a></li>
                        <li class="menu-separator" role="separator"></li>
                        <li><a href="{{ route('api.v1.employment.index') }}" target="_blank">Employment API</a></li>
                        <li><a href="{{ route('api.v1.projects.index') }}" target="_blank">Projects API</a></li>
                        <li><a href="{{ route('api.v1.education.index') }}" target="_blank">Education API</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; 1997–{{ date('Y') }} Michael Ragsdale</p>
                <p class="copyright-milestones">
                    Coding since 1997. RaggieSoft since 2008. This portfolio since 2023.
                </p>
            </div>
        </div>
    </div>
</footer>
