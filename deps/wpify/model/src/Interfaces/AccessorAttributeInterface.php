<?php

declare (strict_types=1);
namespace RelayPayDeps\Wpify\Model\Interfaces;

interface AccessorAttributeInterface extends SourceAttributeInterface
{
    public function set(ModelInterface $model, string $key, mixed $value) : mixed;
}
