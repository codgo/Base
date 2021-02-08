<?php

namespace TypiCMS\Modules\Cats\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Cats\Models\Cat;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Cat::published()->order()->with('image')->get();

        return view('cats::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Cat::published()->whereSlugIs($slug)->firstOrFail();

        return view('cats::public.show')
            ->with(compact('model'));
    }
}
