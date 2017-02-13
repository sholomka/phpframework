<?php
namespace sholomka\controller;

class IndexController extends PageController
{
    public function process()
    {
        echo "<pre>";
        print_r($this->getRequest());
        die;
    }
}