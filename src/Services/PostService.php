<?php

namespace Task\GetOnBoard\Services;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\Comment;
use Task\GetOnBoard\Utils\PostType;
use Task\GetOnBoard\Services\PersistanceInterface\IPostRepository;

class PostService
{
    protected $postRepository;
    public function __construct(IPostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * creates a Post based on type
     * 
     * @param $title
     * @param $text
     * @param $type
     * @return Post|null
     */
    public function createPost($title, $text, $type, $userID, $communityID): Post
    {
        $post = $this->createAbstractPostInstance($text, $type, $userID, $communityID);
        $post->setTitle($title);
        $this->postRepository->add($post);

        return $post;
    }

    /**
     * creates an Article
     *
     * @param string $text
     * @return Post
     */
    public function createConversation($text, $userID, $communityID): Post
    {
        return $this->createAbstractPostInstance($text, PostType::CONVERSATION, $userID, $communityID);
    }

    private function createAbstractPostInstance($text, $type, $userID, $communityID): Post
    {
        $post = new Post();
        $post->setText($text);
        $post->setType($type);
        $post->setUserID($userID);
        $post->setCommunity($communityID);
        return $post;
    }

    /**
     * updates post   
     *
     * @param $postID
     * @param $title
     * @param $text
     * @return void
     */
    public function updatePost($postID, $title, $text)
    {
        $post = $this->postRepository->getByID($postID);
        if ($post == null) return null;
        $post->setTitle($title);
        $post->setText($text);
    }

    /**
     * updates Conversation   
     *
     * @param $postID
     * @param $text
     * @return void
     */
    public function updateConversation($postID, $text)
    {
        $post = $this->postRepository->getByID($postID);
        if ($post == null) return null;
        $post->setText($text);
    }

    /**
     * gets post by id, userID and community
     *
     * @param string $postID
     * @param string $communityID
     * @param string $userID
     * @return Post|null
     */
    public function getPost($postID): Post
    {
        return $this->postRepository->getByID($postID);
    }

    /**
     * removes post
     *
     * @param string $postID
     * @return void
     */
    public function removePost($postID)
    {
        $this->postRepository->removeById($postID);
    }

    /**
     * @param $postID
     * return void
     */
    public function disableCommentsForArticle($postID): void
    {
        $post = $this->postRepository->getByID($postID);

        if ($post != null && $post->type == PostType::ARTICLE) {
            $post->setCommentsAllowed(false);
        }
    }

    public function addCommentToPost($postID, Comment $comment): Comment
    {
        $post = $this->postRepository->getByID($postID);
        if ($post == null) return null;

        $post->addComment($comment);
        return $comment;
    }
}
