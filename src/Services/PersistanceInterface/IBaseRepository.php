<?php

namespace Task\GetOnBoard\Services\PersistanceInterface;

interface IBaseRepository {
    public function getAll();
    public function getByID($id);
    public function add($item);
    public function removeByID($item);
}