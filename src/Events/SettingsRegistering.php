<?php

namespace Marshmallow\NovaSettingsTool\Events;

use Illuminate\Queue\SerializesModels;
use Marshmallow\NovaSettingsTool\ValueObjects\SettingRegister;

/**
 * Class SettingsRegistering
 * @package Marshmallow\NovaSettingsTool\Events
 */
final class SettingsRegistering
{
    use SerializesModels;

    /**
     * @var SettingRegister
     */
    public $settingRegister;

    /**
     * Create a new SettingRegister instance.
     *
     * @param  SettingRegister  $settingRegister
     * @return void
     */
    public function __construct(SettingRegister $settingRegister)
    {
        $this->settingRegister = $settingRegister;
    }
}
