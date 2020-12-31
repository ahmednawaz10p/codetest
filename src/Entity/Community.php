<?php

namespace Task\GetOnBoard\Entity;

class Community implements IEntity
{
    public $id;
    public $name;
    public $posts = [];

    public function __construct()
    {
        $this->id =  uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $postID
     * @return void
     */
    public function addPost(string $postID)
    {
        if ($postID != null ) {
            $this->posts[] = $postID;
        }
    }

    public function removePost(string $postID)
    {
        foreach ($this->posts as $key=>$post) {
            if ($post->getId() == $postID) {
                array_splice($this->posts, $key, 1);
            }
        }
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $id) {
                break;
            }
        }

        $post->setDeleted(true);
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        $posts = [];
        foreach ($this->posts as $post){
            if (!$post->getDeleted()) {
                $posts[] = $post;
            }
        }

        return $posts;
    }
}
