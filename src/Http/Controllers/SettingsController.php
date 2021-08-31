<?php

namespace Marshmallow\NovaSettingsTool\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Marshmallow\NovaSettingsTool\Traits\Settings;
use Marshmallow\NovaSettingsTool\ValueObjects\SettingRegister;

/**
 * Class SettingsController
 * @package Marshmallow\NovaSettingsTool\Http\Controllers
 */
final class SettingsController
{
    /**
     * Get settings.
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return response()->json(SettingRegister::getInstance());
    }

    /**
     * Check if the database migrations are migrated.
     * @return JsonResponse
     */
    public function installed(): JsonResponse
    {
        $connection = config('settings.connection');
        $schema_builder = Schema::connection($connection);
        return response()->json(['installed' => $schema_builder->hasTable('settings')]);
    }

    /**
     * Update settings.
     * @param Request $request
     * @return JsonResponse
     */
    public function process(Request $request): JsonResponse
    {
        $values = $request->get('values');

        if (is_null($values)) {
            $values = [];
        }

        $settingRegister = SettingRegister::getInstance();

        $settingRegister->massUpdate($values);

        return response()->json([
            'settings' => $settingRegister,
            'message' => __('The settings are saved successfully!'),
        ]);
    }
}
