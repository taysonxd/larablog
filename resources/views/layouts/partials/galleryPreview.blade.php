<section>
    <div class="row container gal-container">
        @foreach( $post->photos->take(4) as $photo )
            <div class="{{ $loop->iteration === 1 ? 'col-md-8 col-sm-12 co-xs-12' : 'col-md-4 col-sm-6 co-xs-12' }} gal-item">
                <div class="box">
                    @if( $loop->iteration === 4 )
                        <div class="overlay">{{ $post->photos->count() }} Fotos</div>
                    @endif
                    <img src="{{ url($photo->url) }}">
                    {{-- <div class="modal fade" id="1" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <div class="modal-body">
                                    <img src="http://nabeel.co.in/files/bootsnipp/gallery/1.jpg">
                                </div>
                                <div class="col-md-12 description">
                                    <h4>This is the first one on my Gallery</h4>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
</section>