<?php

namespace Task\GetOnBoard\Services;

use Task\GetOnBoard\Repository\PostRepository;
use Task\GetOnBoard\Repository\UserRepository;
use Task\GetOnBoard\Services\PersistanceInterface\IPostRepository;
use Task\GetOnBoard\Services\PersistanceInterface\IUserRepository;

class UserService  
{
    protected $userRepository;
    protected $postRepository;
    public function __construct(
        IUserRepository $userRepository,
        IPostRepository $postRepository
        )
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }
    /**
     * adds post to a user
     *
     * @param string $userID
     * @param string $postID
     * @return void|null
     */
    public function addPostToUser($userID, $postID) {
        $user = $this->userRepository->getByID($userID);
        if ($user == null) return null;
        $user->addPost($postID);
    }

    public function getUser($userID) {
        return $this->userRepository->getByID($userID);
    }

    /**
     * gets user posts
     *
     * @param string $userID
     * @return Post[]
     */
    public function getUserPosts($userID) {
        $posts = $this->postRepository->getAll();
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
        $user = $this->userRepository->getByID($userID);
        if ($user == null) return null;

        $user->removePost($postID);
    }
}
