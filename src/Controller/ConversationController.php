<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class ConversationController
{
    /**
     * @param $communityId
     * @return array
     *
     * POST
     */
    public function listAction($communityId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $posts = $community->getPosts();

        return $posts;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return \InSided\GetOnBoard\Entity\Post|null
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $title, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'conversation');

        $user = CommunityRepository::getUser($userId);
        $user->addPost($post);

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
    public function updateAction($userId, $communityId, $conversationId, $title, $text)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($conversationId, $title, $text);
            }
        }

        return $post;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $conversationId)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($conversationId);
            }
        }

        return null;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $conversationId, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($conversationId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }
}
