<?php

namespace Task\GetOnBoard\Repository;

use Task\GetOnBoard\Services\PersistanceInterface\IBaseRepository;

abstract class BaseRepository implements IBaseRepository
{
    private $items = [];

   
    public function getAll() {
        return $this->items;
    }

    public function getByID($id)
    {
        foreach ($this->items as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }

        return null;
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function removeById($id) {
        foreach ($this->items as $key=>$item) {
            if ($item->getId() == $id) {
                array_splice($this->items, $key, 1);
            }
        }

        return null;
    }
}
