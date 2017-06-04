<?php

class Tasks extends Controller
{
    public function index()
    {
        $limit = 3;

        $offset = (isset($_GET['page']) ? ($_GET['page']-1)*$limit : 0);
        $order = (isset($_GET['order']) ? $_GET['order'] : 'id');
        $direction = (isset($_GET['direction']) ? $_GET['direction'] : 'asc');

        $this->load('model', 'tasks');
        $tasks = $this->tasks_model->get($order, $direction, $limit, $offset);
        $page_count = intval(count($this->tasks_model->getAll())/$limit);
        if(count($this->tasks_model->getAll()) % $limit != 0) {
            $page_count++;
        }
        $data = [
            'tasks' => $tasks,
            'page_count' => $page_count,
            'order' => $order,
            'direction' => $direction
        ];
        $this->view->generate('task_list', $data);
    }
}