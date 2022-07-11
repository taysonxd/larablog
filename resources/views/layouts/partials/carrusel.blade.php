<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    @foreach ($post->photos as $photo)
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}" {{ $loop->index == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide{{ $loop->index+1 }}"></button>
    @endforeach    
  </div>
  <div class="carousel-inner">
    @foreach ($post->photos as $photo)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <img src="{{ url($photo->url) }}" class="d-block w-100" alt="...">
      </div>
    @endforeach    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>