<?php
include_once("../util/Util.php");
include_once("Comment.php");

class CommentModel {
	
    public function getAllCommentsByPostId($postId) {
        $mysqli = Connection::getCon();

        $sql = "SELECT comment_id, post_id, username, name, email, comment, comment_date FROM comment WHERE post_id = ? ORDER BY comment_id ASC";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

        if (!$stmt->bind_param("i", $postId)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
             echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $results = $res->fetch_all();
        $comments = array();
        $util = new Util();
        foreach ($results as $key => $res) {
            $comment = new Comment($res[0], $res[1], $res[2], $res[3], $res[4], $res[5], $res[6]);
            array_push($comments, $comment);
        }
        $comments = $util->objectsToArray($comments);
        return $comments;
    }
    
    public function addNewComment($data) {
        $mysqli = Connection::getCon();
        
        $sql = "INSERT INTO comment (post_id, username, name, email, comment, comment_date) VALUES (?, ?, ?, ?, ?, ?)";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            $return = "Failed";
        }

        /* Prepared statement, stage 2: bind and execute */
        $postId = $data['postId'];
        $username = $data['username'];
        $name = $data['name'];
        $email = $data['email'];
        $comment = $data['comment'];
        $commentDate = $data['commentDate'];
        
        if (!$stmt->bind_param("isssss", $postId, $username, $name, $email, $comment, $commentDate)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            $return = "Failed";
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $return = "Failed";
        } else {
            $return = "Success";
        }

        $stmt->close();
        return $return;
    }

}

?>