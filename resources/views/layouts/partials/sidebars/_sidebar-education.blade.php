{{-- resources/views/partials/sidebars/_sidebar-education.blade.php --}}
<aside class="site-sidebar">
    <div class="sidebar-inner">

        <div class="widget">
            <h2 class="widget-title">Current Studies</h2>
            <ul class="quick-facts-list">
                <li>
                    <i class="fa-duotone fa-graduation-cap fa-fw"></i>
                    <span><strong>Degree:</strong> A.S., Information Technology (in progress)</span>
                </li>
                <li>
                    <i class="fa-duotone fa-graduation-cap fa-fw"></i>
                    <span><strong>Degree:</strong> B.S., Customized Studies in Leadership (in progress)</span>
                </li>
            </ul>
        </div>

        <div class="widget">
            <h2 class="widget-title">Key Areas of Focus</h2>
            <x-tech-tag-list :tags="['software-engineering', 'database-management', 'web-development', 'leadership', 'team-training', 'communication', 'problem-solving']" />
        </div>

    </div>
</aside>
