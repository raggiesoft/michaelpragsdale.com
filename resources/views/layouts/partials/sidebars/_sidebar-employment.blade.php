{{-- resources/views/partials/_sidebar-employment.blade.php --}}
<aside class="site-sidebar">
    <div class="sidebar-inner">

        <div class="widget">
            <h2 class="widget-title">At a Glance</h2>
            <ul class="quick-facts-list">
                <li>
                    <i class="fa-duotone fa-briefcase fa-fw"></i>
                    <span><strong>Primary Focus:</strong> Web Development & IT</span>
                </li>
                <li>
                    <i class="fa-duotone fa-user-headset fa-fw"></i>
                    <span><strong>Core Strength:</strong> Customer Service & Support</span>
                </li>
                <li>
                    <i class="fa-duotone fa-universal-access fa-fw"></i>
                    <span><strong>Specialty:</strong> Web Accessibility (WCAG)</span>
                </li>
            </ul>
        </div>

        <div class="widget">
            <h2 class="widget-title">Core Technologies</h2>
            <x-tech-tag-list :tags="['c-sharp','powershell','visual-basic-6', 'php', 'javascript', 'html', 'css', 'section-508']" />
        </div>
        <div class="widget">
            <h2 class="widget-title">Soft Skills</h2>
            <x-tech-tag-list :tags="['leadership', 'team-training', 'communication', 'problem-solving']" />
        </div>

    </div>
</aside>
