<figure class="mb-3">
    <a href="#!"><img class="card-img-top" src="{{ url($post->photos->first()->url) }}" alt="..." />
        <img class="img-fluid rounded" src="{{ url($post->photos->first()->url) }}" alt="Photo: {{ $post->title }}" />
    </a>                
</figure>