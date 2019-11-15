<?php

class RegisterPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        var_dump($urlArr);

        if ($urlArr['pageVars'] == 'zzp') {
            $this->register_zzp();
        } else if ($urlArr['pageVars'] == 'bedrijf') {
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