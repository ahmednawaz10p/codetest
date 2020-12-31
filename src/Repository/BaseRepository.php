<?php

namespace Task\GetOnBoard\Repository;

abstract class BaseRepository
{
    // FIXME: add a generic type to fix
    private static $items = [];

   
    public static function getAll() {
        return self::$items;
    }

    public static function getByID($id)
    {
        foreach (self::$items as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }

        return null;
    }

    public static function add($item)
    {
        self::$items[] = $item;
    }

    public static function removeById($id) {
        foreach (self::$items as $key=>$item) {
            if ($item->getId() == $id) {
                array_splice(self::$items, $key, 1);
            }
        }

        return null;
    }
}
