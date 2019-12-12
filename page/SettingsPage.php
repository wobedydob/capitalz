<?php

class SettingsPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if ($urlArr['pageVars'][0] == 'zzp') {
            $this->settings_zzp();
        } else if ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->settings_bedrijf();
        } else {
            header("Refresh: 2; url=" . $urlArr['baseUrl'] . "home");
        }

    }

    private function settings_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string('settings/zzp', array('baseUrl' => $this->urlArr['baseUrl']));

    }

    private function settings_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('settings/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
    }
}