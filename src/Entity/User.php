<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Utils\Authorizable;

class User implements IEntity
{
    use Authorizable;

    private $id;
    private $username;
    private $posts; //for storing post IDs for a user
    private $roles;

    public function __construct()
    {
        $this->id = uniqid();
        $this->posts = [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param $post
     */
    public function addPost($post): void
    {
        $this->posts[] = $post;
    }

    /**
     * remove a user post
     *
     * @param string $postID
     * @return void
     */
    public function removePost(string $postID)
    {
        foreach ($this->posts as $key=>$post) {
            if ($post->getId() == $postID) {
                array_splice($this->posts, $key, 1);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    public function ownsPost(Post $post) {
        if ($post->getUserID() == $this->id) return true;
        return false;
    }

}
