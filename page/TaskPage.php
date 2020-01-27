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
        $db->query('SELECT 
                              `job`.*, 
                              `profile`.`company_name`, 
                              `user`.`number` 
                          FROM `job` 
                          LEFT JOIN `profile_co` AS `profile` ON `company_id` = `user_id` 
                          LEFT JOIN `user` ON `job`.`company_id` = `user`.`user_id` ;');
        $list = $db->resultset();

        $taskStr = '';

        foreach ($list as $value) {

            //USER
            $number = $value['number'];

            //PROFILE
            $company_name = $value['company_name'];

            //JOB
            $title = $value['title'];
            $tag = $value['tag'];
            $desc = $value['desc'];
            $date_start = $value['date_start'];
            $date_end = $value['date_end'];
            $work_hours = $value['work_hours'];
            $work_sal = $value['work_sal'];

            $taskStr .= '    <div class="tasklist-card h-100 card mb-3">
        <div class="row no-gutters tasklist-card-row">
            <div class="col-md-4">
                <img class="tasklist-img card-img" src="' . "IMAGE" . '" alt="task img">
            </div>
            <div class="col-md-8">
                <div class="card-header">
                    <div class="row no-gutters">
                        <div class="col-6">
                            <h2 class="tasklist-title">' . $title . '</h2>
                        </div>
                        <div class="col-6">
                            <div class="row no-gutters">
                                <div class="col-6">
                                    <h6 class="card-text text-right"><b>Bedrijf:</b></h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="card-text tasklist-text-blue text-right">' . $company_name . '</h6>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-6">
                                    <h6 class="card-text text-right"><b>KvK-Nr:</b></h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="card-text tasklist-text-blue text-right">' . $number . '</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tasklist-card-body card-body">
                    <p class="tasklist-card-text card-text">' . $desc . '</p>
                </div>
                <div class="tasklist-footer card-footer">
                    <div class="row no-gutters">
                        <div class="col-6 col-sm-5">
                            <div class="row no-gutters">
                                <div class="col-6 col-sm-4">
                                    <h6 class="card-text"><b>Aantal uur:</b></h6>
                                </div>
                                <div class="col-6 col-sm-8">
                                    <h6 class="card-text text-center mb-2">' . $work_hours . '</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-5">
                            <div class="row no-gutters">
                                <div class="col-6 col-sm-4">
                                    <h6 class="card-text"><b>Uur salaris:</b></h6>
                                </div>
                                <div class="col-6 col-sm-8">
                                    <h6 class="card-text text-center mb-2">' . $work_sal . '</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <button type="button" class="btn btn-block btn-primary tasklist-btn">Meld aan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }

        $taskStr .= '';
        $this->taskList = $taskStr;
    }


}