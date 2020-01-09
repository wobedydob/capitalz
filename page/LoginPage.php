<?php

class LoginPage
{

    public function __construct()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->login($email, $password);
        }
    }

    private function login($email, $password)
    {
        $db = new Database();
        $db->query('SELECT password FROM user WHERE email = :email');
        $db->bind(':email', $email);
        $db->execute();

//        var_dump($password);
//        var_dump($db->single()['password']);

        if (password_verify($password, $db->single()['password'])) {
//            session_start();
            $db->query('SELECT * FROM user WHERE email = :email');
            $db->bind(':email', $email);
            $record = $db->resultset()[0];
//            var_dump($db->resultset());
            $_SESSION["id"] = $record["user_id"];
            $_SESSION["user_role"] = $record["userrole"];
            $_SESSION["email"] = $record["email"];
//            var_dump(session_start());
            echo '<div class="alert alert-success" role="alert">
                Je bent nu ingelogd, je word naar je profiel pagina gestuurd
                </div>';
            header("refresh:1; url=profile/zzp");
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Email of wachtwoord zijn onjuist.
                </div>';
            header("refresh:1; url=login");
        }
    }
}