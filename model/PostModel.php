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
        
        $stmt->close();

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
    
    public function addNewPost($data) {
        $mysqli = Connection::getCon();
        
        $sql = "INSERT INTO post (post_title, post_author, post_date, post_content) VALUES (?, ?, ?, ?)";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            $return = "Failed";
        }

        /* Prepared statement, stage 2: bind and execute */
        $postTitle = $data['postTitle'];
        $postAuthor = $data['postAuthor'];
        $postDate = $data['postDate'];
        $postContent = $data['postContent'];
        if (!$stmt->bind_param("ssss", $postTitle, $postAuthor, $postDate, $postContent)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $return = "Success";
        }

        $stmt->close();
        return $return;
    }
    
    public function updatePost($data)
    {
        $mysqli = Connection::getCon();
        
        $strUpdate = "";
        $fieldCount = 0;
        $col = array();
        
        if( !empty($data['postTitle']) )
        {
            $strUpdate .= "post_title = ? ";
            $fieldCount++;
            array_push($col, $data['postTitle']);
        }
        
        if( !empty($data['postDate']) )
        {
            if ($strUpdate!="")
            {
                $strUpdate .= ", ";
            }
            $strUpdate .= "post_date = ? ";
            $fieldCount++;
            array_push($col, $data['postDate']);
        }
                
        if( !empty($data['postContent']) )
        {
            if ($strUpdate!="")
            {
                $strUpdate .= ", ";
            }
            $strUpdate .= "post_content = ? ";
            $fieldCount++;
            array_push($col, $data['postContent']);
        }
        
        if ($strUpdate!="")
        {
            $strUpdate = "SET " . $strUpdate;
        
            $sql = "UPDATE post ". $strUpdate ." WHERE post_id = ? AND post_author = ?";

            array_push($col, $data['postId']);
            array_push($col, $data['postAuthor']);

            if (!($stmt = $mysqli->prepare($sql))) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
                $return = "Failed";
            }

            /* Prepared statement, stage 2: bind and execute */

            switch(count($col))
            {
                case 3: $binding = $stmt->bind_param("sis", $col[0], $col[1], $col[2]); break;
                case 4: $binding = $stmt->bind_param("ssis", $col[0], $col[1], $col[2], $col[3], $col[4]); break;
                case 5: $binding = $stmt->bind_param("sssis", $col[0], $col[1], $col[2], $col[3], $col[4]); break;
            }

            if (!$binding) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                $return = array(
                    "affected_row" => $stmt->affected_rows
                );
            }

            $stmt->close();
        }
        else {
            $return = array("affected_row" => 0);
        }
        return $return;
    }
	
}

?>