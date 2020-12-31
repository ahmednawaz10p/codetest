<?php

namespace Task\GetOnBoard\Utils;

class Role {
    private $permissions = [];

    public function setPermission($permission) {
        $this->permissions[] = $permission;
    }

    public function getPermissions() {
        return $this->permissions;
    }
}