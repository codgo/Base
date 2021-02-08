<?php

namespace TypiCMS\Modules\Downloads\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Downloads\Models\Download;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Download::published()->order()->with('image')->get();

        return view('downloads::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Download::published()->whereSlugIs($slug)->firstOrFail();

        return view('downloads::public.show')
            ->with(compact('model'));
    }
}
