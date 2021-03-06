<?php

namespace Marshmallow\NovaSettingsTool;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Illuminate\View\View;

/**
 * Class Settings
 * @package Marshmallow\NovaSettingsTool
 */
class NovaSettingsTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('settings', __DIR__.'/../dist/js/tool.js');
        Nova::style('settings', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return View
     */
    public function renderNavigation(): View
    {
        return view('settings::navigation');
    }
}
