<?php

namespace sholomka\controller;

use sholomka\base\RequestRegistry;

abstract class PageController
{
    abstract public function process();

    public function forward($resource)
    {
        include($resource);
        exit(0);
    }

    public function getRequest()
    {
        return RequestRegistry::getRequest();
    }
}
