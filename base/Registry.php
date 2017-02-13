<?php

namespace sholomka\base;

abstract class Registry
{
    abstract protected function get($key);
    abstract protected function set($key, $val);
}
