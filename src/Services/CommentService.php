<?php

namespace Task\GetOnBoard\Services;

use Task\GetOnBoard\Entity\Comment;

class CommentService
{
    public function createComment($text, $userID, $postID)
    {
        $comment = new Comment();
        $comment->setUserID($userID);
        $comment->setText($text);
        $comment->setPostID($postID);
        return $comment;
    }
}
