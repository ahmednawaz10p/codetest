<?php

namespace Task\GetOnBoard\Entity;

class Post
{
    private $id;
    private $text;
    private $title;
    private $type;
    private $comments;
    private $deleted;
    private $commentsAllowed = true;
    private $communityID;
    private $userID;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->id =  uniqid();
        $this->comments = [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $communityID
     */
    public function setCommunity($communityID): void
    {
        $this->$communityID = $communityID;
    }

    /**
     * @return string
     */
    public function getCommunityID(): string
    {
        return $this->communityID;
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
     * @param $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

 

    /**
     * @param $text
     * @return Comment
     */
    public function addComment(Comment $comment)
    {
        if ($this->commentsAllowed)
            $this->comments[] = $comment;

        return $comment;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function isCommentsAllowed(): bool
    {
        return $this->commentsAllowed;
    }

    /**
     * @param mixed $commentsAllowed
     */
    public function setCommentsAllowed($commentsAllowed)
    {
        if (!$commentsAllowed) {
            $this->comments = [];
        }

        $this->commentsAllowed = $commentsAllowed;
    }
}
