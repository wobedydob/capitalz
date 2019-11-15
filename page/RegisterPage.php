<?php

class RegisterPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if ($urlArr['pageVars'][0] == 'zzp') {
            $this->register_zzp();
        } else if ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->register_bedrijf();
        }

    }

    private function register_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string('register/zzp', array('baseUrl' => $this->urlArr['baseUrl']));

    }

    private function register_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('register/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
    }
}