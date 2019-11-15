<?php

class ApplicationController extends ApplicationModel
{

    public $pageObj;

    public function __construct()
    {
        $this->parse_url('http://www.capitalz.net/');
        $this->load_page();
        //$this->set_pageObj( new PageController( $this->urlArr ) );
    }

    private function parse_url($baseUrl)
    {
        $varStr = str_replace($baseUrl, '', (isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI']));
        $urlVars = (strpos($varStr, '/') !== false ? explode('/', $varStr) : array($varStr));

        $count = count($urlVars);

        $urlArr['baseUrl'] = $baseUrl;
        $urlArr['pagename'] = false;
        $urlArr['pageVars'] = false;

        if (strpos(end($urlVars), '.') !== false) return;

        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                if (!empty($urlVars[$i])) {
                    if ($i == 1) $urlArr['pagename'] = $urlVars[$i];
                    else $urlArr['pageVars'][$i] = $urlVars[$i];
                }
            }
        }

        $this->set_urlArr($urlArr);
    }

    private function load_page()
    {
        $page = $this->urlArr['pagename'];

        if (empty($page)) $page = 'home';

        $objName = ucfirst(strtolower($page)) . 'Page';
        $this->pageObj = new $objName($this->urlArr);

        $this->get_part('header');

        require 'view/' . $page . '.phtml';

        $this->get_part('footer');
    }

    public function get_part($name, array $vars = array())
    {
        $file = 'view/parts/' . $name . '.phtml';

        if (file_exists($file)) include $file;
        else var_dump($file);
    }

    public static function get_part_string($name, array $vars = array())
    {
        $file = 'view/parts/' . $name . '.phtml';

        if (file_exists($file)) {
            ob_start();
            require $file;
            $return = ob_get_contents();
        } else {
            $return = false;
        }

        ob_end_clean();

        return $return;

    }
}