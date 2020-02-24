<?php

class Task_zzpPage
{
    public $taskList;

    public function __construct()
    {
//        $this->show_result();
        $this->taskList();
    }

    public function taskList()
    {
        $db = new Database();
        $db->query('SELECT * FROM `job`;');

        $result = $db->resultset();
        //$tableStr = '<table>';
        $taskStr = '';
        foreach ($result as $value) {
            $taskStr .= '<div class="card" style="width: 18rem;">';
            $taskStr .= '<h4 class="card-title">' . $value['title'] . '</h4> ';
            $taskStr .= '<p class="card-title">' . $value['desc'] . '</p> ';
            $taskStr .= '<p class="card-title" style="font-size: 13px;">' . $value['tag'] . '</p> ';
            $taskStr .= '</div>';
        }
        //$tableStr .= '</table>';
        $this->taskList = $taskStr;
    }
}