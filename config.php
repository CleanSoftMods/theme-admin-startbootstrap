<?php

return array(
    // theme info
    'name'    => 'default_admin',
    'inherit' => null,

    'events' => array(
        'before' => function ($theme) {
            $theme->setTitle(config('cms.core.app.site-name').' Admin Panel');

            // Breadcrumb template.
            $theme->breadcrumb()->setTemplate('
                <ol class="breadcrumb">
                @foreach ($crumbs as $i => $crumb)
                    @if ($i != (count($crumbs) - 1))
                    <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a></li>
                    @else
                    <li class="active">{{ $crumb["label"] }}</li>
                    @endif
                @endforeach
                </ol>
            ');
        },

        'asset' => function ($theme) {
            $theme->add('app', 'themes/default_admin/css/app.css');
            $theme->add('all.js', 'themes/default_admin/js/all.js');
        },

        // add dropdown-menu classes and such for the bootstrap toggle
        'beforeRenderTheme' => function ($theme) {
            Menu::handler('acp')->addClass('nav')->id('side-menu');

            Menu::handler('acp')
                ->getAllItemLists()
                ->map(function ($itemList) {
                    if ($itemList->getParent() !== null && $itemList->hasChildren()) {
                        $itemList->addClass('nav nav-second-level');
                    }
                });

            // add dropdown class to the li if the set has children
            Menu::handler('acp')
                ->getItemsByContentType('Menu\Items\Contents\Link')
                ->map(function ($item) {
                    if ($item->hasChildren()) {
                        $item->getValue()->addClass('text-center title');
                    }
                });

            // set the nav up for the sidenav
            Menu::handler('acp.config_menu')->addClass('nav');
        }
    )
);
