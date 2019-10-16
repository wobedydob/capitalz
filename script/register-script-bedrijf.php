<?php
    include("connect_db.php");
    include("functions.php");

    $email = sanitize($_POST["email"]);

    if (!empty($email)){

    // Maak een select query om te controleren of het email adres al bestaat.

    $sql = "SELECT * from `register` WHERE `email` = '$email'";

    // Stuur de query af op de database
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0 )
    {
        header("refresh:2; url=./index.php?content=register");
        die('<div class="alert alert-danger" role="alert">
        This email is already being used, please try with a different email.
      </div>');
    } else {
      $password = 'geheim';
      $password_hash = password_hash($password, PASSWORD_BCRYPT);

         $sql = "INSERT INTO `register` (`id`,
                                    `email`,
                                    `password`,
                                    `userrole`)
                            VALUES (NULL,
                                    '$email',
                                    'geheim',
                                    'bedrijf')";

    $result = mysqli_query($conn, $sql);

    // Hiermee vraag je de door de autonummering gemaakt id op
    $id = mysqli_insert_id($conn);

    if($result){
        // Verstuur de email met de activatielink naar de persoon die zich registreert.
        $to = $email;
        $subject = "Activation link for account loginregistration";
        $message = "<!DOCTYPE html>
                    <html>
                      <head>
                      <title>Page Title</title>
                      <style>
                        h1{
                          background-color: orange;
                          padding: 1em;
                        }
                      </style>
                      </head>
                    <body>
                    
                    <h1>Dear user,</h1>
                    <p>You have recently registered for our site www.loginregistration322085.stateu.org</p>
                    <p>To complete the activation process please press on the activation link</p>
                      <a href='loginregistration322085.stateu.org/index.php?content=choosepassword&id=" . $id . "&pw=" . $password_hash ."'>
                        Click here to activate
                      </a> 
                    <p>Sincerely,</p>
                    <p> Wob Jelsma</p>
                    <p> CEO loginregistration.com</p>
                    
                    </body>
                    </html>";

        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";
        $headers .= "From: wobjelsma@loginregistration.com"."\r\n";
        $headers .= "Cc: 322085@student.mboutrecht.nl"."\r\n";
        $headers .= "Bcc: wobjelsm@gmail.com";
        // echo $to . " | " . $subject . " | " . $message . " | " . $headers; exit();

        mail($to, $subject, $message, $headers);

        echo '<div class="alert alert-success" role="alert">
                Your email submitted successfully.
              </div>';
        header("refresh:2; url=./index.php?content=register");
    } else {
        echo '<div class="alert alert-warning" role="alert">
        Something wrong happened, please try again later.
      </div>';
      header("refresh:2; url=./index.php?content=register");
    }
    }
    } else {
        echo '<div class="alert alert-warning" role="alert">
        You have not given an email, please try again.
      </div>';
      header("refresh:2; url=./index.php?content=register");
    }
?>