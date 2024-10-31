<?php

declare (strict_types=1);
namespace RelayPayDeps\DI;

use RelayPayDeps\Psr\Container\ContainerExceptionInterface;
/**
 * Exception for the Container.
 */
class DependencyException extends \Exception implements ContainerExceptionInterface
{
}
