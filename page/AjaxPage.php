<?php

class AjaxPage
{
    private $functionVars;

    public function __construct($urlVars)
    {
        $functionName = $urlVars['pageVars'][0];

        $this->$functionName();
    }

    private function search()
    {
        $input = $_POST['input'];

        $db = new Database();

        $db->query('SELECT * FROM question WHERE title LIKE "%:input%"');
        $db->bind(':input', $input);

        if ($db->execute() && $db->resultset()) {
            $this->create_overview($db->resultset());
        }
    }

    private function create_overview($results)
    {
        $overview = '';
        foreach ($results as $result) {
            //$vars['title']
            $overview .= ApplicationController::get_part_string('searchblock', $result);
        }
        echo $overview;
        // foreach loop
        // // load part
        //
    }

}