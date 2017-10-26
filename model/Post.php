<?php

class Post {
	private $postId;
    private $postTitle;
    private $postAuthor;
    private $postContent;
    private $postDate;
	private $postComments;
	
	public function __construct($postId, $postTitle, $postAuthor, $postContent, $postDate)  
    {
        $this->postId = $postId;
        $this->postTitle = $postTitle;
        $this->postAuthor = $postAuthor;
        $this->postContent = $postContent;
		$this->postDate = $postDate;
    }

    public static function create() 
    {
    	$instance = new self();
    	return $instance;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    public function getPostTitle()
    {
        return $this->postTitle;
    }

    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;
        return $this;
    }

    public function getPostAuthor()
    {
        return $this->postAuthor;
    }

    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;
        return $this;
    }

    public function getPostContent()
    {
        return $this->postContent;
    }

    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
        return $this;
    }

    public function getPostDate()
    {
        return $this->postDate;
    }

    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
        return $this;
    }
    
}

?>