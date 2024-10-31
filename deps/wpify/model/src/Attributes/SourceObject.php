<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */
declare (strict_types=1);
namespace RelayPayDeps\Wpify\Model\Attributes;

use Attribute;
use RelayPayDeps\Wpify\Model\Interfaces\ModelInterface;
use RelayPayDeps\Wpify\Model\Interfaces\SourceAttributeInterface;
#[Attribute(Attribute::TARGET_PROPERTY)]
class SourceObject implements SourceAttributeInterface
{
    public function __construct(public ?string $key = null)
    {
    }
    public function get(ModelInterface $model, string $key) : mixed
    {
        $keys = \explode('.', $this->key ?? $key);
        $current = $model->source();
        foreach ($keys as $object_property) {
            if (isset($current->{$object_property})) {
                $current = $current->{$object_property};
            } else {
                return null;
            }
        }
        return $current;
    }
}
