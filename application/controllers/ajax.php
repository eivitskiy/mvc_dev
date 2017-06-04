<?php

class Ajax extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['auth']) || !$_SESSION['auth']) {
            return Routing::error(404);
        }
        if (
            !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
            empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        ) {

            return Routing::error(404);
        }
    }

    public function add_task()
    {
        $this->load('model', 'tasks');
        $this->load('library', 'image');

        $files = $_FILES;
        foreach($_POST as $key => $value) {
            $post[$key] = htmlspecialchars(trim($value));
        }

        foreach($files as $file) {
            $uploaded = $this->image->upload($file);
        }

        $data = [
            'username' => $post['username'],
            'email' => $post['email'],
            'text' => $post['text'],
            'images' => serialize($uploaded)
        ];
        $this->tasks_model->insert($data);

        $this->response(['status'=>true]);
    }
}