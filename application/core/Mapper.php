<?php

namespace Application\Core;

use Application\Core\Registry\ApplicationRegistry;
use Application\Exceptions\AppException;

abstract class Mapper
{
    protected static $PDO;

    public function __construct()
    {
        if (!isset(self::$PDO)) {
            $dsn = ApplicationRegistry::getDSN();

            if (is_null($dsn)) {
                throw new AppException('DSN не определен');
            }

            self::$PDO = new \PDO($dsn, 'root', '');
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function find($id)
    {
        $this->selectStmt()->execute([$id]);
        $array = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();

        if (!is_array($array)) {
            return null;
        }

        if (!isset($array['id'])) {
            return null;
        }

        $object = $this->createObject($array);
        return $object;
    }

    public function createObject($array)
    {
        $obj = $this->doCreateObject($array);
        return $obj;
    }

    public function insert($obj)
    {
        $this->doInsert($obj);
    }

    abstract function update(\Application\Core\DomainObject $object);
    protected abstract function doCreateObject(array $array);
    protected abstract function doInsert(\Application\Core\DomainObject $object);
    protected abstract function selectStmt();
}
