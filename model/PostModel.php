<?php
include_once("util/Util.php");
include_once("model/Post.php");

class PostModel {
	
	public function getAllPosts() 
    {
        $allPost = array();
        // prepare and bind
        $sql = "SELECT post_id, post_title, post_author, post_content, post_date FROM post";
    	$resSql = mysqli_query(Connection::getCon(),$sql);

    	while($row = mysqli_fetch_assoc($resSql))
    	{
    		array_push($allPost, $row);
    	}

    	return $allPost;
    }

    public function getAllPostsByAuthor($author) {
        $mysqli = Connection::getCon();

        $sql = "SELECT post_id, post_title, post_author, post_content, post_date FROM post WHERE post_author = ? ORDER BY post_id ASC";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("s", $author)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $results = $res->fetch_all();
        $posts = array();
        $util = new Util();
        foreach ($results as $key => $res) {
            $post = new Post($res[0], $res[1], $res[2], $res[3], $res[4]);
            array_push($posts, $post);
        }
        $posts = $util->objectsToArray($posts);
        return $posts;
    }

    public function getPostById($author, $id) {
        $mysqli = Connection::getCon();

        $sql = "SELECT post_id, post_title, post_author, post_content, post_date FROM post WHERE post_author = ? AND post_id = ?";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("ss", $author, $id)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $results = $res->fetch_all();
        $posts = array();
        $util = new Util();
        foreach ($results as $key => $res) {
            $post = new Post($res[0], $res[1], $res[2], $res[3], $res[4]);
            array_push($posts, $post);
        }
        $posts = $util->objectsToArray($posts);
        return $posts;
    }
	
}

?>