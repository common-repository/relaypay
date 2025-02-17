<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */
declare (strict_types=1);
namespace RelayPayDeps\Wpify\Model\Attributes;

use Attribute;
use RelayPayDeps\Wpify\Model\Exceptions\RepositoryNotFoundException;
use RelayPayDeps\Wpify\Model\Interfaces\ModelInterface;
use RelayPayDeps\Wpify\Model\Interfaces\SourceAttributeInterface;
use RelayPayDeps\Wpify\Model\MenuItem;
#[Attribute(Attribute::TARGET_PROPERTY)]
class MenuItemsRelation implements SourceAttributeInterface
{
    public function __construct(public string $target_entity = MenuItem::class)
    {
    }
    /**
     * @throws RepositoryNotFoundException
     */
    public function get(ModelInterface $model, string $key) : array
    {
        $wp_items = wp_get_nav_menu_items($model->id);
        $repository = $model->manager()->get_model_repository($this->target_entity);
        $items = array();
        foreach ($wp_items as $wp_item) {
            $items[] = $repository->get($wp_item);
        }
        return $this->sort_items($items);
    }
    public function sort_items($items, $parent_id = 0)
    {
        $result = array();
        foreach ($items as $item) {
            if ($item->menu_item_parent == $parent_id) {
                $item->children = $this->sort_items($items, $item->id);
                $result[$item->id] = $item;
            }
        }
        return \array_values($result);
    }
}
