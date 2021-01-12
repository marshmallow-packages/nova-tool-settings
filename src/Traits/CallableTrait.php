<?php

namespace Marshmallow\NovaSettingsTool\Traits;

use Closure;
use ReflectionFunction;
use ReflectionException;
use Illuminate\Routing\RouteDependencyResolverTrait;

/**
 * Trait CallableTrait
 * @package Marshmallow\NovaSettingsTool\Traits
 */
trait CallableTrait
{
    use RouteDependencyResolverTrait;

    /**
     * Perform a callback.
     * @param Closure|null $callback
     * @param null $caller
     * @return null
     * @throws ReflectionException
     */
    public function call(Closure $callback = null, $caller = null)
    {
        if ($callback instanceof Closure) {
            $parameters = $this->resolveMethodDependencies(
                [$caller],
                new ReflectionFunction($callback)
            );
            call_user_func_array($callback, $parameters);
        }

        return $caller;
    }
}
