<?php

require_once 'API.class.php';
require_once '../config/Connection.php';
require_once '../model/PostModel.php';
require_once '../model/CommentModel.php';

class MyAPI extends API
{
    protected $PostModel;
    protected $CommentModel;
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        $this->PostModel = new PostModel();
        $this->CommentModel = new CommentModel();
    }

    /**
     * Endpoint
     */
	 protected function user()
	 {
		 include ('user.php');
         return $response;
	 }
	 
	 
    protected function posts()
    {
        if ($this->method == 'GET')
        {
            $args = $_GET['request'];
            $args = explode("/", $args);
            $author = $args[1];
            $id = $args[2];

            if( empty($author) )
            {
                return array(
                    'data' => array("message" => "Method not allowed"),
                    'status' => 405
                );
            }
            else
            {
                if( empty($id) )
                {
                    return array(
                        'data' => $this->PostModel->getAllPostsByAuthor($author),
                        'status' => 200
                    );
                }
                else
                {
                    return array(
                        'data' => $this->PostModel->getPostById($author, $id),
                        'status' => 200
                    );
                }
            }
        }

        else if ($this->method == 'POST')
        {
            $args = $_GET['request'];
            $args = explode("/", $args);
            $action = $args[1];

            if (empty($action))
            { 
                return array(
                    'data' => array("message" => "Method not allowed"),
                    'status' => 405
                );
            }
            else
            if ($action == "add") // ADD POST
            {
                if( empty($_POST["postTitle"]) && empty($_POST["postAuthor"]) && empty($_POST["postDate"]) && empty($_POST["postContent"]))
                {
                    return array(
                        'data' => array("message" => "Mandatory Parameter is Missing"),
                        'status' => 405
                    );
                } else {
                    return array(
                        'data' => 
                            array(
                                "message" => $this->PostModel->addNewPost(
                                    array(
                                        "postTitle" => $this->sanitize($_POST["postTitle"]),
                                        "postAuthor" => $this->sanitize($_POST["postAuthor"]),
                                        "postDate" => $this->sanitize($_POST["postDate"]),
                                        "postContent" => $this->sanitize($_POST["postContent"])
                                    )
                                ),
                            ),
                        'status' => 200
                    );
                }
            }
            else
            if ($action == "update") // UPDATE POST
            {
                if (empty ($_POST['postId']) || empty ($_POST['postAuthor'])) {
                    return array(
                        'data' => array("message" => "Mandatory Parameter is Missing"),
                        'status' => 422
                    );
                } else {
                    $data = array(
                        "postId" => $this->sanitize($_POST["postId"]),
                        "postAuthor" => $this->sanitize($_POST["postAuthor"])
                    );
                    
                    if( !empty($_POST['postTitle']))
                    {
                        $data["postTitle"] = $this->sanitize($_POST['postTitle']);
                    }
                    
                    if( !empty($_POST['postDate']))
                    {
                        $data["postDate"] = $this->sanitize($_POST['postDate']);
                    }
                    
                    if( !empty($_POST['postContent']))
                    {
                        $data["postContent"] = $this->sanitize($_POST['postContent']);
                    }
                    
                    return array(
                        'data' => 
                            array(
                                "message" => $this->PostModel->updatePost($data)
                            ),
                        'status' => 200
                    );
                }
            }
            else
            if ($action == "delete") // DELETE POST
            {
                if( empty($_POST["postId"]) || empty($_POST["postAuthor"]))
                {
                    return array(
                        'data' => array("message" => "Mandatory Parameter is Missing"),
                        'status' => 405
                    );
                } else {
                    return array(
                        'data' => 
                            array(
                                "message" => $this->PostModel->deletePost(
                                    array(
                                        "postId" => $_POST["postId"], "postAuthor" => $_POST["postAuthor"]
                                        )
                                    )
                            ),
                        'status' => 200
                    );
                }
            }
        }

        else
        {
            return array(
                'data' => "Method not allowed",
                'status' => 405
            );
        }
    }
    
    protected function comments()
    {
        if ($this->method == 'GET')
        {
            $args = $_GET['request'];
            $args = explode("/", $args);
            $postId = $args[1];

            if( empty($postId) )
            {
                return array(
                    'data' => array("message" => "Method not allowed"),
                    'status' => 405
                );
            }
            else
            {
                return array(
                    'data' => $this->CommentModel->getAllCommentsByPostId($postId),
                    'status' => 200
                ); 
            }
        }
        else
        if ($this->method == 'POST')
        {
            if( !isset($_POST['postId']) || !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['comment']) ) {
                return array(
                    'data' => array("message" => "Method not allowed"),
                    'status' => 405
                );
            }
            else
            {
                return array(
                        'data' => 
                            array(
                                "message" => $this->CommentModel->addNewComment(
                                    array(
                                        "postId" => $this->sanitize($_POST["postId"]),
                                        "username" => $this->sanitize($_POST["username"]),
                                        "name" => $this->sanitize($_POST["name"]),
                                        "email" => $this->sanitize($_POST["email"]),
                                        "comment" => $this->sanitize($_POST["comment"]),
                                        "commentDate" => date('Y-m-d H:i:s')
                                    )
                                ),
                            ),
                        'status' => 200
                    );
            }
        }
        else {
            return array(
                'data' => array("message" => "Method not allowed"),
                'status' => 405
            );
        }
    }
    
    function sanitize($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
 }
