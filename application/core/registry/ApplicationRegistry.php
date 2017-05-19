<?php

namespace Application\Core;

use  Application\Exceptions\AppException;
use  Application\Core\Request;
use  Application\Core\Registry;

/**
 * Class ApplicationRegistry - основной реест приложения
 * @package Application\Core
 */
class ApplicationRegistry extends Registry
{
    /**
     * Синглтон
     *
     * @var null
     */
    private static $instance = null;

    /**
     * Путь к конфигу
     *
     * @var
     */
    private $config;

    /**
     * Массив для значений реестра
     *
     * @var array
     */
    private $values = [];

    /**
     * Запрос пользователя
     *
     * @var
     */
    private $request;

    /**
     * ApplicationRegistry constructor.
     */
    private function __construct()
    {
        $this->config = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'web.xml']));
    }

    /**
     * Вывод ошибок
     *
     * @param $expr
     * @param $message
     * @throws \Exception
     */
    private function ensure($expr, $message)
    {
        if (!$expr) {
            throw new AppException($message);
        }
    }

    /**
     * Получает настройки из конфига
     */
    private function getOptions()
    {
        $this->ensure(file_exists($this->config), 'Файл конфигурации не найден');
        $options = @SimpleXML_load_file($this->config);
        $dsn = $options->dsn;
        $username = $options->username;
        $password = $options->password;

        $this->ensure($options instanceof \SimpleXMLElement, 'Файл конфигурации запорчен');
        $this->ensure($dsn, 'DSN не найден');
        self::setDSN($dsn);
        self::setUserName($username);
        self::setPassword($password);
    }

    /**
     * Устанавливает DSN
     *
     * @param $dsn
     */
    private static function setDSN($dsn)
    {
        self::instance()->set('dsn', $dsn);
    }

    /**
     * Устанавливает имя пользователя
     *
     * @param $username
     */
    private static function setUserName($username)
    {
        self::instance()->set('username', $username);
    }

    /**
     * Устанавливает пароль
     *
     * @param $password
     */
    private static function setPassword($password)
    {
        self::instance()->set('password', $password);
    }

    /**
     * Извлекает значения из реестра
     *
     * @param $key
     * @return mixed|null
     */
    protected function get($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    /**
     * Добавляет значение в реестр
     *
     * @param $key
     * @param $val
     */
    protected function set($key, $val)
    {
        $this->values[$key] = $val;
    }

    /**
     * Получает DSN
     *
     * @return mixed|null
     */
    public static function getDSN()
    {
        return self::instance()->get('dsn');
    }

    /**
     * Синглтон
     *
     * @return ApplicationRegistry|null
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *  Инициализация реестра и получения настроек
     */
    public function init()
    {
        $dsn = self::getDSN();

        if (!is_null($dsn)) {
            return;
        }

        $this->getOptions();
    }
}