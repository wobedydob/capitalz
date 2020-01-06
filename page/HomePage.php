<?php

class HomePage
{
    public function SearchHome($title, $input)
    {
        $db = new Database();
        $db->query('SELECT * FROM job WHERE $title LIKE "%:input%"');
        $db->bind(':input', $input);
        $db->execute();
        var_dump($db->resultset());
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}