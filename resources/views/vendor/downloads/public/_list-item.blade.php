<li class="download-list-item">
    <a class="download-list-item-link" href="{{ $download->uri() }}" title="{{ $download->title }}">
        <div class="download-list-item-title">{{ $download->title }}</div>
        <div class="download-list-item-image-wrapper">
            @empty (!$download->image)
            <img class="download-list-item-image" src="{{ $download->present()->image(null, 200) }}" width="{{ $download->image->width }}" height="{{ $download->image->height }}" alt="{{ $download->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
