<?php

namespace Task\GetOnBoard\Entity;

class Comment
{
    private $id;
    private $text;
    private $userID;
    private $postID;

    public function __construct()
    {
        $this->id =  uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getUserID(): string
    {
        return $this->userID;
    }

    /**
     * @param $userID
     */
    public function setUserID($userID): void
    {
        $this->$userID = $userID;
    }

    /**
     * @return string
     */
    public function getPostID(): string
    {
        return $this->postID;
    }

    /**
     * @param $postID
     */
    public function setPostID($postID): void
    {
        $this->$postID = $postID;
    }
}
