<?php

class TaskPage
{
    public $taskList;

    public function __construct()
    {
//        $this->show_result();
//        $this->taskList();
        $this->getTasks();
    }


//    public function taskList()
//    {
//        $db = new Database();
//        $db->query('SELECT * FROM `job`;');
//
//        $result = $db->resultset();
//        //$tableStr = '<table>';
//        $taskStr = '';
//        foreach ($result as $value) {
//            $taskStr .= '<div class="card" style="width: 18rem;">';
//            $taskStr .= '<h4 class="card-title">' . $value['title'] . '</h4> ';
//            $taskStr .= '<p class="card-title">' . $value['tag'] . '</p> ';
//            $taskStr .= '<p class="card-title" style="font-size: 13px;">' . $value['desc'] . '</p> ';
//            $taskStr .= '</div>';
//        }
//        //$tableStr .= '</table>';
//        $this->taskList = $taskStr;
//    }

    public function getTasks()
    {
        $db = new Database();
        $db->query('SELECT * FROM `job`;');
        var_dump($db->resultset());
        $list = $db->resultset();

//        $taskStr = '<div class="tasklist-card h-100 card mb-3">
//                     <div class="row no-gutters tasklist-card-row">';

        $taskStr = '';
//        $taskStr .= '<div class="tasklist-card h-100 card mb-3">';
//        $taskStr .= '<div class="row no-gutters tasklist-card-row">';

        foreach ($list as $value) {
            $title = $value['title'];
            $tag = $value['tag'];
            $desc = $value['desc'];
            $date_start = $value['date_start'];
            $date_end = $value['date_end'];
            $workHours = $value['work_hours'];
            $workSal = $value['work_sal'];

            $taskStr .= '';

        }
//        $taskStr .= '</div></div></div>';

        $taskStr .= '';
        $this->taskList = $taskStr;
    }


}