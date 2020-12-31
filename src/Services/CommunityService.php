<?php 

namespace Task\GetOnBoard\Services;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Repository\CommunityRepository;
use Task\GetOnBoard\Repository\PostRepository;

class CommunityService
{
    /**
     * gets all posts for a community
     * 
     * @param $communityID
     * @return Post[]
     */
    public function getAllCommunityPosts($communityID)
    {
        $community = CommunityRepository::getByID($communityID);
        return $community->getPosts();
    }

    /**
     * adds post to community
     *
     * @param string $communityID
     * @param string $postID
     * @return void|null
     */
    public function addPostToCommunity($communityID, $postID) {
        $community = CommunityRepository::getByID($communityID);
        if ($community == null) return null;
        $community->addPost($postID);
        
    }

    /**
     * remove post from community
     *
     * @param string $communityID
     * @param string $postID
     * @return void
     */
    public function removePostFromCommunity($communityID, $postID) {
        $community = CommunityRepository::getByID($communityID);
        if ($community == null) return null;

        $community->removePost($postID);
    }

    /**
     * gets a post for a community
     *
     * @param string $communityID
     * @param string $postID
     * @return Post|null
     */
    public function getCommunityPost($communityID, $postID): Post {
        $posts = PostRepository::getAll();
        foreach ($posts as $post) {
            if ($post->getCommunityID() == $communityID && $post->getID() == $postID)
                return $post;
        }     

        return null;
    }
}
