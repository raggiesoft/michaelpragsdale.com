{{-- resources/views/partials/sidebars/_sidebar-about.blade.php --}}
<aside class="site-sidebar">
    <div class="sidebar-inner">
        <div class="widget">
            <h2 class="widget-title">At a Glance</h2>
            <ul class="quick-facts-list">
                <li>
                    <i class="fa-duotone fa-location-dot fa-fw"></i>
                    <span><strong>Location:</strong> Norfolk, VA</span>
                </li>
                <li>
                    <i class="fa-duotone fa-briefcase fa-fw"></i>
                    <span><strong>Seeking:</strong> Remote (VA) or <a href="{{ url('contact#location') }}">Local In-Office</a></span>
                </li>
                <li>
                    <i class="fa-duotone fa-graduation-cap fa-fw"></i>
                    <span><strong>Studying:</strong> IT & Leadership</span>
                </li>
                <li>
                    <i class="fa-duotone fa-universal-access fa-fw"></i>
                    <span><strong>Focus:</strong> WCAG Accessibility</span>
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
</aside>
