<?php

class CreatePage
{
    public function __construct()
    {
        $this->create();
    }

    public function create()
    {
        if (isset($_POST['create_submit'])) {
            $user_id = ApplicationController::sanitize($_SESSION['id']);
            $title = ApplicationController::sanitize($_POST['title']);
            $tag = ApplicationController::sanitize($_POST['tag']);
            $desc = ApplicationController::sanitize($_POST['desc']);
            $date_start = ApplicationController::sanitize($_POST['date_start']);
            $date_end = ApplicationController::sanitize($_POST['date_end']);
            $work_hours = ApplicationController::sanitize($_POST['work_hours']);
            $work_sal = ApplicationController::sanitize($_POST['work_sal']);
//            $company_name = ApplicationController::sanitize($_POST['company_name']);

            if (isset($user_id)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `user_id` = :user_id");
                $db->bind(':user_id', $user_id);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($db);
//                var_dump($user_id);
                $db->execute();

                if ($db->rowCount() > 1) {
                    $db = new Database();
                    $db->query('INSERT INTO `job` (`company_id`, `title`, `tag`, `desc`, `date_start`, `date_end`, `work_hours`, `work_sal`, `company_name`)
                               VALUES (:company_id, :title, :descr, :date_start, :date_end, :work_hours, :work_sal, NULL)');
                    $db->bind(':company_id', $user_id);
                    $db->bind(':title', $title);
                    $db->bind(':tag', $tag);
                    $db->bind(':descr', $desc);
                    $db->bind(':date_start', $date_start);
                    $db->bind(':date_end', $date_end);
                    $db->bind(':work_hours', $work_hours);
                    $db->bind(':work_sal', $work_sal);
//                    var_dump($db);
                    $db->execute();
                    echo '<div class="alert alert-success" role="alert">Gelukt!</div>';
                    header("refresh:1; url=../home");
                } else {
                }
            }
        }
    }
}