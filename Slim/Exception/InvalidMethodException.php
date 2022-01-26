<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Exception;

use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;

class InvalidMethodException extends InvalidArgumentException
{
    /**
     * @param string                 $method
     */
    public function __construct(protected ServerRequestInterface $request, $method)
    {
        parent::__construct(sprintf('Unsupported HTTP method "%s" provided', $method));
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
