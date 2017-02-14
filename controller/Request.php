<?php

namespace Controller;

class Request
{
    private $properties;
    private $feedback = [];

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


    public function addFeedback($msg)
    {

echo "<pre>"; print_r($this->feedback);
        array_push($this->feedback, $msg);

    }

    public function getFeedback()
    {
        return $this->feedback;
    }

    public function getFeedbackString($separator = "\n")
    {
        echo "<pre>"; print_r($this->feedback);
        return implode($separator, $this->feedback);
    }
}
