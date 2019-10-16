<?php
    // var_dump($_POST);
    include("./connect_db.php");
    include("./functions.php");

    $id = sanitize($_POST["id"]);
    $password = sanitize($_POST["password"]);
    $checkpassword = sanitize($_POST["checkpassword"]);
    $pw = sanitize($_POST["pw"]);

    if (!empty($password) && !empty($checkpassword)){
        if (!strcmp($password, $checkpassword)){

            // Check met een select of het id bestaat in de database en of het gehashte password match met het id
            $sql = "SELECT * from `register` WHERE `id` = $id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1 ){
                $record = mysqli_fetch_assoc($result);

                if(password_verify($record["password"], $pw)){
                    $blowfish_password = password_hash($password, PASSWORD_BCRYPT);
    
                    $sql = "UPDATE `register` SET `password` = '$blowfish_password'
                            WHERE `id` = $id";
                            
                    $result = mysqli_query($conn, $sql);

                    if ($result){
                        echo '<div class="alert alert-success" role="alert">
                        Your password submitted successfully.
                        </div>';
                        header("refresh:2; url=./index.php?content=login-form");
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                        Your password failed to submit.
                        </div>';
                        header("refresh:2; url=./index.php?content=choosepassword&id=$id");
                    }
                }else {
                    // Het password en id matchen niet
                    echo '<div class="alert alert-danger" role="alert">
                    The given id and password do not match.
                    </div>';
                    header("refresh:2; url=./index.php?content=homepage");
                }
            } else {
                // Het id bestaat niet
                echo '<div class="alert alert-warning" role="alert">
                The given id does not exist.
                </div>';
                header("refresh:2; url=./index.php?content=homepage");
            }

        } else {
            echo '<div class="alert alert-warning" role="alert">
            The given passwords do not match. Please try again...
            </div>';
            header("refresh:2; url=./index.php?content=choosepassword&id=$id&pw=$pw");
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
        You have not entered a password. Please try again...
        </div>';
        header("refresh:2; url=./index.php?content=choosepassword&id=$id&pw=$pw");
    }
?>