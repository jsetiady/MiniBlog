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
    protected function example() {
        if ($this->method == 'GET') {
            return "Your name is Jeje";
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function posts() {
        return $this->PostModel->getAllPosts();
    }
 }
