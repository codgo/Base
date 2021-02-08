<?php

namespace TypiCMS\Modules\Downloads\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read downloads')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Downloads'), function (SidebarItem $item) {
                $item->id = 'downloads';
                $item->icon = config('typicms.downloads.sidebar.icon');
                $item->weight = config('typicms.downloads.sidebar.weight');
                $item->route('admin::index-downloads');
                $item->append('admin::create-download');
            });
        });
    }
}
