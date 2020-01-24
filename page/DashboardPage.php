<?php

class DashboardPage
{
    public $zzpForm;
    public $bedrijfForm;
    public $adminForm;

    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if (isset($urlArr['pageVars'][0]) && $urlArr['pageVars'][0] == 'zzp') {
            $this->dashboard_zzp();
        } else if (isset($urlArr['pageVars'][0]) && $urlArr['pageVars'][0] == 'bedrijf') {
            $this->dashboard_bedrijf();
        } else if (isset($urlArr['pageVars'][0]) && $urlArr['pageVars'][0] == 'admin') {
            $this->dashboard_admin();
        } else {
            header("Refresh: 2; url=" . $urlArr['baseUrl'] . "home");
        }
    }

    private function dashboard_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string('dashboard/zzp', array('baseUrl' => $this->urlArr['baseUrl']));

    }

    private function dashboard_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('dashboard/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
    }

    private function dashboard_admin()
    {
        $this->adminForm = ApplicationController::get_part_string('dashboard/admin', array('baseUrl' => $this->urlArr['baseUrl']));
    }
}