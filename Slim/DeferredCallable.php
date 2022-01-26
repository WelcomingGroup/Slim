<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim;

use Closure;
use Psr\Container\ContainerInterface;

class DeferredCallable
{
    use CallableResolverAwareTrait;

    /**
     * @var callable|string
     */
    private $callable;

    /**
     * @param callable|string $callable
     * @param ContainerInterface $container
     */
    public function __construct($callable, private readonly ContainerInterface $container = null)
    {
        $this->callable = $callable;
    }

    /**
     * @return callable|string
     */
    public function getCallable(): callable|string
    {
        return $this->callable;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $callable = $this->resolveCallable($this->callable);
        if ($callable instanceof Closure) {
            $callable = $callable->bindTo($this->container);
        }

        $args = func_get_args();

        return call_user_func_array($callable, $args);
    }
}
