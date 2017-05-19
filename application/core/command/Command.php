<?php

namespace Application\Core\Command;

use Application\Core\Request\Request;

/**
 * Class Command
 * @package Application\Core\Command
 */
abstract class Command
{
    /**
     * Command constructor.
     */
    final public function __construct()
    {
    }

    /**
     * @param Request $request
     */
    public function execute(Request $request)
    {
        $this->doExecute($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    abstract public function doExecute(Request $request);
}