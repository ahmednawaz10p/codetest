<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Services\CommunityService;
use Task\GetOnBoard\Services\PostService;
use Task\GetOnBoard\Services\UserService;
use Task\GetOnBoard\Utils\PostType;

class PostController
{
    protected $communityService;
    protected $postService;
    protected $userService;
    public function __construct(
        CommunityService $communityService, 
        PostService $postService,
        UserService $userService
        )
    {
        $this->communityService = $communityService;
        $this->postService = $postService;
        $this->userService = $userService;
    }

    /**
     * show posts for a community
     * @param $communityId
     * @return array
     *
     */
    public function listAction($communityId)
    {
        return $this->communityService->getAllCommunityPosts($communityId);
    }

    /**
     * create post for community
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $title, $text, $type)
    {
        $post = null;
        if ($type == PostType::CONVERSATION) {
            $post = $this->postService->createConversation($text, $userId, $communityId);
        } else if ($type == PostType::ARTICLE || $type == PostType::QUESTION ) {
            $post = $this->postService->createPost($title, $text, $type, $userId, $communityId);
        }

        if ($post == null) return null;

        $this->communityService->addPostToCommunity($communityId, $post->getId());
        $this->userService->addPostToUser($userId, $post->getId());
        // TODO: exception handling

        return $post;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return mixed
     *
     * PUT
     *
     */
    public function updateAction($userId, $communityId, $postId, $title, $text)
    {
        $post = $this->postService->getPost($postId, $communityId, $userId);
        if ($post == null) return null;
        if ($post->getType() == PostType::CONVERSATION) {
            return $this->postService->updateConversation($postId, $text);
        }   
        $post = $this->postService->updatePost($postId, $title, $text);

        return $post;
    }

    /**
     * deletes a post
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $postID)
    {

        $this->communityService->removePostFromCommunity($communityId, $postID);
        $this->userService->removePostFromUser($userId, $postID);
        $this->postService->removePost($postID);

        return null;
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH
     */
    public function disableCommentsAction($communityId, $postId)
    {
        $this->postService->disableCommentsForArticle($postId);        
    }
}
