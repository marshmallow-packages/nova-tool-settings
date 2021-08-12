<?php

namespace Marshmallow\NovaSettingsTool\Entities;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingValue
 * @package Marshmallow\NovaSettingsTool\Entities
 */
class SettingValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value',
    ];

    /**
     * Get the SettingValues by its key.
     * @param string $key
     * @return Collection
     */
    public static function findByKey(string $key): Collection
    {
        if (trim($key) == '') {
            return collect([]);
        }

        return self::query()->where('key', $key)->get();
    }
}
