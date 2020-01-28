<?php

class LoginPage
{
    public $formMessage;

    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->login($email, $password);
        }
    }

    private function login($email, $password)
    {
        if (!empty($email)) {
            if (!empty($password)) {
                $db = new Database();
                $db->query('SELECT password FROM user WHERE email = :email');
                $db->bind(':email', $email);
                $db->execute();

                if (password_verify($password, $db->single()['password'])) {
                    $db->query('SELECT * FROM user WHERE email = :email');
                    $db->bind(':email', $email);
                    $record = $db->resultset()[0];
                    $_SESSION['id'] = $record['user_id'];
                    $_SESSION['email'] = $record['email'];
                    $_SESSION['user_role'] = (int)$record['user_role'];


                    if ($_SESSION["user_role"] === 0) {
                        $this->formMessage = '<div class="alert alert-warning" role="alert">Inlog geslaagd! Welkom administrator.</div>';
                        $url = "home";
                    } elseif ($_SESSION["user_role"] === 1) {
                        $this->formMessage = '<div class="alert alert-success" role="alert">Inlog geslaagd! Welkom eigenaar bedrijf!</div>';
                        $url = "profile_edit/bedrijf";
                    } elseif ($_SESSION["user_role"] === 2) {
                        $this->formMessage = '<div class="alert alert-success" role="alert">Inlog geslaagd! Welkom ZZP\'er!</div>';
                        $url = "profile_edit/zzp";
                    } else {
                        $this->formMessage = '<div class="alert alert-danger" role="alert"><strong>!! ERR: USER_ROLE NOT DEFINED !!</strong></div>';
                        unset($_SESSION["user_role"]);
                        $url = "home";
                    }
                } else {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Email of wachtwoord is onjuist.</div>';
                    $url = "login";
                }
            } else {
                $this->formMessage = '<div class="alert alert-danger" role="alert">Voer een wachtwoord in!</div>';
                $url = "login";
            }
        } else {
            $this->formMessage = '<div class="alert alert-danger" role="alert">Voer een email in!</div>';
            $url = "login";
        }
        header("Refresh: 1; url=" . $this->urlArr['baseUrl'] . $url);
    }
}