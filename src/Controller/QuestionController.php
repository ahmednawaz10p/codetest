<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class QuestionController
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
     * @return
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $title, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'question');

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
    public function updateAction($userId, $communityId, $questionId, $title, $text)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $questionId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($questionId, $title, $text);
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
    public function deleteAction($userId, $communityId, $questionId)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $questionId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($questionId);
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
    public function commentAction($userId, $communityId, $questionId, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($questionId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }
}
