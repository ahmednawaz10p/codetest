<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class ArticleController
{
    /**
     * @param $communityId
     * @return array
     *
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
        $post = $community->addPost($title, $text, 'article');

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
    public function updateAction($userId, $communityId, $articleId, $title, $text)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($articleId, $title, $text);
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
    public function deleteAction($userId, $communityId, $articleId)
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($articleId);
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
    public function commentAction($userId, $communityId, $articleId, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($articleId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH
     */
    public function disableCommentsAction($communityId, $articleId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $community->disableCommentsForArticle($articleId);
    }
}
