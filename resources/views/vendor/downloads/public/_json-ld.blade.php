{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $download->title }}",
    "description": "{{ $download->summary !== '' ? $download->summary : strip_tags($download->body) }}",
    "image": [
        "{{ $download->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $download->uri() }}"
    }
}
</script>
--}}
