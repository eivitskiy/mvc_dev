<?php

class Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION['auth']) && $_SESSION['auth']) {
            header('Location: /');
        }
    }

    public function index()
    {
        $this->view->generate('auth');
    }

    public function login()
    {
        $post = [];
        foreach($_POST as $k=>$value) {
            $post[$k] = htmlspecialchars(trim($value));
        }

        $this->load('model', 'users');
        $user = $this->users_model->getByUsername($post['username']);

        if(md5($post['password']) == $user->password) {
            $_SESSION['userdata'] = $user;
            $_SESSION['auth'] = true;
            header('Location: /');
        } else {
            exit('не подходит');
        }
    }

    public function logout()
    {
        unset($_SESSION['userdata']);
        unset($_SESSION['auth']);
        header('Location: /');
    }
}