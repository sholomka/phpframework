<?php

include_once('controller/PageController.php');
include_once('base/Registry.php');
include_once('base/RequestRegistry.php');
include_once('controller/IndexController.php');
include_once('controller/Request.php');

$page = new \sholomka\controller\IndexController();
$page->process();
