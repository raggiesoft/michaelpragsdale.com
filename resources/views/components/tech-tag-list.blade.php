<div class="tech-tags">
    @foreach ($tagsToDisplay as $tag)
        <span class="tag tag-{{ $tag['slug'] }}">{{ $tag['name'] }}</span>
    @endforeach
</div>
