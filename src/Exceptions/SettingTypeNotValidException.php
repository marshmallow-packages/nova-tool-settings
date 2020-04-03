<?php

namespace Marshmallow\NovaSettingsTool\Exceptions;

use Exception;

/**
 * Class SettingTypeNotValidException
 * @package Marshmallow\NovaSettingsTool\Exceptions
 */
final class SettingTypeNotValidException extends Exception
{
    /**
     * SettingTypeNotValidException constructor.
     * @param string $inputType
     */
    public function __construct(string $inputType = "")
    {
        parent::__construct("`{$inputType}` is not a valid SettingType.", 0, null);
    }
}