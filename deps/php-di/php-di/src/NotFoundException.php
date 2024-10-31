<?php

declare (strict_types=1);
namespace RelayPayDeps\DI;

use RelayPayDeps\Psr\Container\NotFoundExceptionInterface;
/**
 * Exception thrown when a class or a value is not found in the container.
 */
class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
