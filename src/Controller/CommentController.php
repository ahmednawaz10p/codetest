<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Services\PostService;
use Task\GetOnBoard\Services\UserService;
use Task\GetOnBoard\Services\CommentService;

class CommentController
{
    protected $commentService;
    protected $postService;
    protected $userService;
    public function __construct(
        CommentService $commentService, 
        PostService $postService,
        UserService $userService
        )
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->userService = $userService;
    }

    

    /**
     * adds comment to a post
     * @param $communityId
     * @param $title
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $postId, $text)
    {

        $comment = $this->commentService->createComment($text, $userId, $postId);
        return $this->postService->addCommentToPost($postId, $comment);
    }
}
