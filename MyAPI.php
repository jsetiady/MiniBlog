<?php

require_once 'API.class.php';
require_once 'config/Connection.php';
require_once 'model/PostModel.php';

class MyAPI extends API
{
    protected $PostModel;
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        $this->PostModel = new PostModel();
    }

    /**
     * Endpoint
     */
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
                    'status' => 404
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
                    'status' => 404
                );
            }
            else
            if ($action == "add") // ADD POST
            {
                return array(
                    'data' => 
                        array(
                            "message" => $this->PostModel->addNewPost(
                                array(
                                    "postTitle" => $_POST["postTitle"], "postAuthor" => $_POST["postAuthor"], "postDate" => $_POST["postDate"], "postContent" => $_POST["postContent"])
                                ),
                        ),
                    'status' => 200
                );
            }
            else
            if ($action == "update") // UPDATE POST
            {

            }
            else
            if ($action == "delete") // DELETE POST
            {

            }
        }

        else
        {
            return array(
                'data' => "Method not allowed",
                'status' => 404
            );
        }
    }
 }
