<ul class="download-list-list">
    @foreach ($items as $download)
    @include('downloads::public._list-item')
    @endforeach
</ul>
