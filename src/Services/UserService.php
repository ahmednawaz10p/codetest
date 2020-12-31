<?php

namespace Task\GetOnBoard\Services;

use Task\GetOnBoard\Repository\PostRepository;
use Task\GetOnBoard\Repository\UserRepository;

class UserService
{
    
    /**
     * adds post to a user
     *
     * @param string $userID
     * @param string $postID
     * @return void|null
     */
    public function addPostToUser($userID, $postID) {
        $user = UserRepository::getByID($userID);
        if ($user == null) return null;
        $user->addPost($postID);
    }

    public function getUserPosts($userID) {
        $posts = PostRepository::getAll();
        $userPosts = [];
        foreach ($posts as $post) {
            if ($post->getUserID() == $userID) {
                $userPosts[] = $post;
            }
        }

        return $userPosts;
    }

    /**
     * remove post from community
     *
     * @param string $communityID
     * @param string $postID
     * @return void
     */
    public function removePostFromUser($userID, $postID) {
        $user = UserRepository::getByID($userID);
        if ($user == null) return null;

        $user->removePost($postID);
    }
}
