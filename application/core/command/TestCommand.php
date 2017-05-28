<?php


namespace Application\Core\Command;

use Application\Core\Request\Request;


class TestCommand extends Command
{
    public function doExecute(Request $request)
    {
        $request->addFeedback('Добро пожаловать в Test!');
        include_once(APPLICATION_PATH . 'views' . DIRECTORY_SEPARATOR . 'test_view.php');
    }
}