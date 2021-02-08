@extends('core::public.master')

@section('title', $model->title.' – '.__('Downloads').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-downloads body-download-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="download">
    <header class="download-header">
        <div class="download-header-container">
            <div class="download-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Downloads', 'model' => $model])
            </div>
            <h1 class="download-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="download-body">
        @include('downloads::public._json-ld', ['download' => $model])
        @empty(!$model->summary)
        <p class="download-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="download-picture">
            <img class="download-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="download-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->body)
        <div class="rich-content">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </div>
</article>

@endsection
