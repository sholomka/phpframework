<?php

namespace sholomka\controller;

class Request
{
    private $properties;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->properties = $_REQUEST;
            return;
        }
    }

    public function getProperty($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    public function setProperty($key, $val)
    {
        $this->properties[$key] = $val;
    }
}
