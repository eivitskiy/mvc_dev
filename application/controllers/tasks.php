<?php

class Tasks extends Controller
{
    public function index()
    {
        $data = [
            'tasks' => [1,2,3,4]
        ];
        $this->view->generate('task_list', $data);
    }
}