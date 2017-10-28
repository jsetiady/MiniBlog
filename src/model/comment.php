<?php 
	
class Comment {
	private $commentId;
    private $postId;
    private $username;
    private $name;
    private $email;
	private $comment;
	private $commentDate;
	
	public function __construct($commentId, $postId, $username, $name, $email, $comment, $commentDate)  
    {
        $this->commentId = $commentId;
        $this->postId = $postId;
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->comment = $comment;
        $this->commentDate = $commentDate;
    }

    public function toArray() {
        $util = new Util();
        return $util->utf8ize(array(
            "commentId" => $this->commentId,
            "postId" => $this->postId,
            "username" => $this->username,
            "name" => $this->name,
            "email" => $this->email,
            "comment" => $this->comment,
            "commentDate" => $this->commentDate,
        ));
    }
}
?>
