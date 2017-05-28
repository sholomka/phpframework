<?php

namespace Application\Core\Command;

use Application\Core\Request\Request;

/**
 * Class DefaultCommand
 * @package Application\Core\Command
 */
class DefaultCommand extends Command
{
    public function doExecute(Request $request)
    {
        $request->addFeedback('Добро пожаловать в Woo!');
        include_once(APPLICATION_PATH . 'views' . DIRECTORY_SEPARATOR . 'main_view.php');
    }
}