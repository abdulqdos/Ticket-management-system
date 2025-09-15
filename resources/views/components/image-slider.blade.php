@php
    $images = $record->getMedia();
    dd($images);
@endphp

@if(!empty($images))
    <div class="carousel">
        @foreach ($images as $media)

{{--            @dd($media)--}}

            <div class="carousel-item">
                <img src="{{ $media->getUrl() }}" class="rounded-lg shadow-md"  alt=""/>
            </div>
        @endforeach
    </div>
@endif
