<?php

namespace Task\GetOnBoard\Utils;

trait Authorizable {
    public function can ($permission) {
        foreach ($this->getRoles as $role) {
            foreach($role->getPermissions() as $per) {
                if ($per === $permission) return true;
            }
        }

        return false;
    }
}