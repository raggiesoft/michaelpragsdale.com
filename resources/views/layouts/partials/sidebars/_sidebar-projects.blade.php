{{-- /resources/views/layouts/partials/sidebars/_sidebar-projects.blade.php --}}
<aside class="sidebar">
    <div class="widget">
        <h3 class="widget-title">My Work</h3>
        <p>This section showcases a selection of my personal and professional projects. Each one represents a unique challenge and a learning opportunity.</p>
    </div>
    <div class="widget">
        <h3 class="widget-title">Developer Tools</h3>
        <ul class="sidebar-links">
            <li>
                <a href="{{ url('/api-docs') }}">
                    <i class="fa-duotone fa-fw fa-book"></i>
                    <span>API Documentation</span>
                </a>
            </li>
            <li>
                <a href="https://github.com/raggiesoft" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-fw fa-github"></i>
                    <span>View on GitHub</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="widget">
        <h3 class="widget-title">Have a Project in Mind?</h3>
        <p>If you're interested in collaborating or have a project you'd like to discuss, please feel free to get in touch.</p>
        <a href="{{ url('/contact') }}" class="button button-primary button-sm">Contact Me</a>
    </div>
</aside>
