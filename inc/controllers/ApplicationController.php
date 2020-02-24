<?php

class ApplicationController extends ApplicationModel
{
    public $pageObj;

    public function __construct()
    {

    }

    public static function getInstance()
    {
        static $instance;
        if (!$instance) {
            $instance = new static();
            $instance->parse_url();
            $instance->load_page();
        }
        return $instance;
    }

    private function parse_url()
    {
        $varStr = explode('/', rtrim($_REQUEST['__uri'], '/'));
        $urlArr = [];
        $urlArr['baseUrl'] = rtrim(str_replace($_REQUEST['__uri'], '', $_SERVER['REQUEST_URI']), '/');
        $urlArr['pagename'] = array_shift($varStr);
        $urlArr['pageVars'] = $varStr;
        $this->set_urlArr($urlArr);
    }

    private function load_page()
    {
        $page = $this->urlArr['pagename'];
        if (empty($page)) $page = 'home';
        $objName = ucfirst(strtolower($page)) . 'Page';
        $this->pageObj = new $objName($this->urlArr);
        if ($page == 'ajax') exit;
        $this->get_part('header');
        require 'view/' . $page . '.phtml';
        $this->get_part('footer');
    }

    public function url($sub_url = '')
    {
        $basePath = dirname(dirname(__DIR__)) . '/';
        return rtrim(rtrim($this->urlArr['baseUrl'], '/') . '/' . rtrim($sub_url, '/'), '/') . (is_file($basePath . $sub_url) ? '' : '/');
    }

    public static function get_url($input)
    {
        if (substr($input, 0, 4) !== "http") $input = 'http://' . $input;
        return $input;
    }

    public function get_part($name, array $vars = array())
    {
        $file = 'view/parts/' . $name . '.phtml';
        if (file_exists($file)) require $file;
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

    public static function svg_helper($name)
    {
        $file = 'img/svg/' . $name . '.svg';
        if (file_exists($file)) {
            $return = file_get_contents($file);
        } else {
            echo $file;
            exit;
        }
        return $return;
    }

    public static function sanitize($raw_data)
    {
        $data = htmlspecialchars($raw_data);
        $data = self::escape($data);
        return $data;
    }

    public static function escape($value)
    {
        $return = '';
        for ($i = 0; $i < strlen($value); ++$i) {
            $char = $value[$i];
            $ord = ord($char);
            if ($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
                $return .= $char;
            else
                $return .= '\\x' . dechex($ord);
        }
        return $return;
    }
}