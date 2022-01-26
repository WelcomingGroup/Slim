<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Exception;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MethodNotAllowedException extends SlimException
{
    /**
     * @param string[]               $allowedMethods
     */
    public function __construct(ServerRequestInterface $request, ResponseInterface $response, protected array $allowedMethods)
    {
        parent::__construct($request, $response);
    }

    /**
     * @return string[]
     */
    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }
}
