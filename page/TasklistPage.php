<?php

class TasklistPage
{
    public $taskList;

    public function __construct()
    {
        $this->getTasks();
    }

    public function getTasks()
    {
        $db = new Database();
        $db->query('SELECT 
                              `job`.*, 
                              `profile`.`company_name`, 
                              `profile`.`city`,
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
            $location = $value['city'];

            //JOB
            $title = $value['title'];
            $tag = $value['tag'];
            $desc = $value['desc'];
            $date_start = $value['date_start'];
            $date_end = $value['date_end'];
            $work_hours = $value['work_hours'];
            $work_sal = $value['work_sal'];

            $start_format = date("d-m-Y", strtotime($date_start));
            $end_format = date("d-m-Y", strtotime($date_end));
            $date_start = $start_format;
            $date_end = $end_format;

            $taskStr .=
                '<div class="tasklist-card h-100 card mb-3">
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
                                                <h6 class="card-text text-right"><b>Loctatie:</b></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="card-text tasklist-text-blue text-right">' . $location . '</h6>
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
                                                <h6 class="card-text text-center">' . $work_hours . ' uur</h6>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-6 col-sm-4">
                                                <h6 class="card-text"><b>Uur salaris:</b></h6>
                                            </div>
                                            <div class="col-6 col-sm-8">
                                                <h6 class="card-text text-center">€ ' . $work_sal . '</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-5">
                                        <div class="row no-gutters">
                                            <div class="col-6 col-sm-4">
                                                <h6 class="card-text"><b>Start datum:</b></h6>
                                            </div>
                                            <div class="col-6 col-sm-8">
                                                <h6 class="card-text text-center">' . $date_start . '</h6>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-6 col-sm-4">
                                                <h6 class="card-text"><b>Eind datum:</b></h6>
                                            </div>
                                            <div class="col-6 col-sm-8">
                                                <h6 class="card-text text-center">' . $date_end . '</h6>
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
                </div>
                ';
        }
        $this->taskList = $taskStr;
    }
}