<?php

namespace controller;

use Base\RequestRegistry;

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
