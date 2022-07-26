<div>
    @foreach ($post->tags as $tag)
        <a class="badge bg-info text-decoration-none link-light" href="{{ route('tags.show', $tag) }}">#{{ $tag->name }}</a>
    @endforeach
</div>