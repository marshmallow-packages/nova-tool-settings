<?php
if (!function_exists('settings')) {
    function settings()
    {
        \Marshmallow\NovaSettingsTool\ValueObjects\SettingRegister::getInstance();
    }
}

if (!function_exists('setting')) {
    function setting(string $key)
    {
        return \Marshmallow\NovaSettingsTool\ValueObjects\SettingRegister::getSettingItem($key);
    }
}

if (!function_exists('settingValue')) {
    function settingValue(string $key)
    {
        $settingValue = config('settings.model')::findByKey($key);
        if ($settingValue->count() > 0) {
            return $settingValue->first()->value;
        }
        return null;
    }
}
