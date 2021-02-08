<?php

namespace TypiCMS\Modules\Downloads\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Downloads\Exports\Export;
use TypiCMS\Modules\Downloads\Http\Requests\FormRequest;
use TypiCMS\Modules\Downloads\Models\Download;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('downloads::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' downloads.xlsx';

        return Excel::download(new Export($request), $filename);
    }

    public function create(): View
    {
        $model = new Download();

        return view('downloads::admin.create')
            ->with(compact('model'));
    }

    public function edit(download $download): View
    {
        return view('downloads::admin.edit')
            ->with(['model' => $download]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $download = Download::create($request->validated());

        return $this->redirect($request, $download);
    }

    public function update(download $download, FormRequest $request): RedirectResponse
    {
        $download->update($request->validated());

        return $this->redirect($request, $download);
    }
}
