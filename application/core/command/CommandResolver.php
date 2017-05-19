<?php

namespace Application\Core\Command;

use Application\Core\Request\Request;

/**
 * Class CommandResolver
 * @package Application\Core\Command
 */
class CommandResolver
{
    /**
     * @var null|\ReflectionClass
     */
    private static $baseCmd = null;

    /**
     * @var DefaultCommand|null
     */
    private static $defaultCmd = null;

    /**
     * CommandResolver constructor.
     */
    public function __construct()
    {
        if (is_null(self::$baseCmd)) {
            self::$baseCmd = new \ReflectionClass('Application\Core\Command\Command');
            self::$defaultCmd = new DefaultCommand();
        }
    }

    /**
     * @param Request $request
     * @return DefaultCommand|null|object
     */
    public function getCommand(Request $request)
    {
        $cmd = $request->getProperty('cmd');
        $sep = DIRECTORY_SEPARATOR;

        if (!$cmd) {
            return self::$defaultCmd;
        }

        $cmd = str_replace(['.', $sep], '', $cmd);
        $filePath = "application{$sep}core{$sep}command{$sep}{$cmd}.php";
        $className = "Application\\Core\\Command\\$cmd";

        if (file_exists($filePath)) {
            require_once($filePath);

            if (class_exists($className)) {
                $cmdClass = new \ReflectionClass($className);

                if ($cmdClass->isSubclassOf(self::$baseCmd)) {
                    return $cmdClass->newInstance();
                } else {
                    $request->addFeedback("Объект Command команды '$cmd' не найден");
                }
            }
        }

        $request->addFeedback("Команда '$cmd' не найдена");
        return clone self::$defaultCmd;
    }
}