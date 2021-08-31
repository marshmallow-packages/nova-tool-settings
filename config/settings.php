<?php

use Laravel\Nova\Http\Middleware\Authorize;
use Laravel\Nova\Http\Middleware\BootTools;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Http\Middleware\DispatchServingNovaEvent;

return [

    /*
    |----------------------------------------------------------------------------------------
    | The setting model
    |----------------------------------------------------------------------------------------
    |
    | You can override this with your own model. Make sure your own model extends
    | our default SettingValue model.
    |
    */
    'model' => \Marshmallow\NovaSettingsTool\Entities\SettingValue::class,


    /*
    |----------------------------------------------------------------------------------------
    | The setting model connection
    |----------------------------------------------------------------------------------------
    |
    | You can override the connection which will be used to check the installtion
    |
    */
    'connection' => null,

    /*
    |----------------------------------------------------------------------------------------
    | Settings Tool Page Title
    |----------------------------------------------------------------------------------------
    |
    | Show the title of the module in the header of the settings tool page.
    |
    */

    'show_title'    => true,


    /*
    |----------------------------------------------------------------------------------------
    | Setting Tab Suffix
    |----------------------------------------------------------------------------------------
    |
    | The suffix of the tab title on the settings tool page (space included automatically).
    | The suffix can be set in the translation (the default suffix is ` Settings`).
    |
    */

    'show_suffix'   => true,


    /*
    |----------------------------------------------------------------------------------------
    | Setting Tab Prefix Icon
    |----------------------------------------------------------------------------------------
    |
    | Determines if the prefix of the tab title on the settings tool page can hold an icon.
    | The icon can be set when a settings group is created.
    |
    */

    'show_icons'    => true,
];
