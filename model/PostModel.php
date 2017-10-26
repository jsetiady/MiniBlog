<?php
include_once("model/Post.php");

class PostModel {
	
	public function getAllPosts() 
    {
    	$allPost = array();

    	$sql = "SELECT post_id, post_title, post_author, post_content, post_date from post";
    	
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql))
    	{
    		array_push($allPost, $row);
    	}

    	return $allPost;
    }
	
}

?>