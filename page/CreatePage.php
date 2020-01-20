<?php

class CreatePage
{

    public $formMessage;

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
//            $company_name = ApplicationController::sanitize($_SESSION['company_name']);

//            var_dump($_POST);
//            var_dump($_SESSION);

            if (isset($user_id)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `user_id` = :user_id AND user_role = :user_role");
                $db->bind(':user_id', $user_id);
                $db->bind(':user_role', 1);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($db);
//                var_dump($user_id);
                $db->execute();

                if ($db->rowCount() < 1) {
                    header("refresh:2; url=/home");
                    die('<div class="alert alert-danger" role="alert">Deze opdracht heeft u al aangemaakt</div>');
                } else {
                    $db = new Database();
                    $db->query('INSERT INTO `job` (`company_id`, `title`, `tag`, `desc`, `date_start`, `date_end`, `work_hours`, `work_sal`, `company_name`)
                               VALUES (:company_id, :title, :tag, :descr, :date_start, :date_end, :work_hours, :work_sal, :company_name)');
                    $db->bind(':company_id', $user_id);
                    $db->bind(':title', $title);
                    $db->bind(':tag', $tag);
                    $db->bind(':descr', $desc);
                    $db->bind(':date_start', $date_start);
                    $db->bind(':date_end', $date_end);
                    $db->bind(':work_hours', $work_hours);
                    $db->bind(':work_sal', $work_sal);
                    $db->bind(':company_name', NULL);
//                    var_dump($db);
                    $db->execute();
                    $this->formMessage = '<div class="alert alert-success" role="alert">Opdracht aangemaakt</div>';
                    header("refresh:1; url=../home");
                }
            }
        }
    }
}