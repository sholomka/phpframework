<?php

namespace Application\Core;

use Application\Core\Registry\ApplicationRegistry;
use Application\Core\Registry\RequestRegistry;
use Application\Core\Command\CommandResolver;



/**
 * Class Controller
 * @package Application\Core
 */
class Controller
{
    /**
     * @var
     */
    private $applicationHelper;

    /**
     * Controller constructor.
     */
    private function __construct()
    {
    }

    /**
     *
     */
    public static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();

        $mapper = new \Application\Core\VenueMapper();
//
//        $venue = $mapper->find(2);

        $venue = new \Application\Core\Venue();
        $venue->setName('The Likey Lounjge-yy');

        $mapper->insert($venue);


        echo "<pre>"; print_r($venue);

    }

    /**
     *
     */
    public function init()
    {
        $applicationRegistry = ApplicationRegistry::instance();
        $applicationRegistry->init();
    }


    /**
     *
     */
    public function handleRequest()
    {
        $request = RequestRegistry::getRequest();

        $cmdR = new CommandResolver();
        $cmd = $cmdR->getCommand($request);
        $cmd->execute($request);
    }
}
