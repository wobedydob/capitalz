<?php

// Dit is de schoonmaak functie van de $_POST array waarden
    function sanitize($raw_data) {
        global $conn;
        $data = htmlspecialchars($raw_data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

?>