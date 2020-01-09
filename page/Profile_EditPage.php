<?php

class Profile_EditPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if ($urlArr['pageVars'][0] == 'zzp') {
            $this->profile_edit_zzp();
        } else if ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->profile_edit_bedrijf();
        } else {
            header("Refresh: 2; url=" . $urlArr['baseUrl'] . "home");
        }

    }

    private function profile_edit_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string('profile_edit/zzp', array('baseUrl' => $this->urlArr['baseUrl']));

    }

    private function profile_edit_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('profile_edit/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
    }
}