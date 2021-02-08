<ul class="download-list-results-list">
    @foreach ($items as $download)
    <li class="download-list-results-item">
        <a class="download-list-results-item-link" href="{{ $download->uri() }}" title="{{ $download->title }}">
            <span class="download-list-results-item-title">{{ $download->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
