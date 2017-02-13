<?php

namespace sholomka\base;

use sholomka\controller\Request;

class RequestRegistry extends Registry
{
    private $values = [];
    private static $instance = null;

    private function __construct()
    {
    }

    protected function get($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    protected function set($key, $val)
    {
        $this->values[$key] = $val;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return  self::$instance;
    }


    public static function getRequest()
    {
        $instance = self::getInstance();

        if (is_null($instance->get('request'))) {
            $instance->set('request', new Request());
        }

        return $instance->get('request');
    }
}
