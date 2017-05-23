<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23.05.2017
 * Time: 14:14
 */

namespace Application\Core;

use Application\Core\Mapper;
use Application\Core\Venue;

class VenueMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct();

        $this->selectStmt = self::$PDO->prepare("SELECT * FROM users WHERE id=?");
        $this->updateStmt = self::$PDO->prepare("UPDATE users SET name=?, id=?, WHERE id=?");
        $this->insertStmt = self::$PDO->prepare("INSERT INTO users (name) values(?)");
    }


    public function getCollection()
    {

    }

    protected function doCreateObject(array $array)
    {
        $obj = new Venue($array['id']);
        $obj->setName($array['name']);
        return $obj;
    }

    protected function doInsert(\Application\Core\DomainObject $object)
    {
        $values = [
            $object->getName()
        ];
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    public function update(\Application\Core\DomainObject $object)
    {
        $values = [
            $object->getName(),
            $object->getId(),
            $object->getId()
        ];

        $this->updateStmt->execute($values);
    }


    public function selectStmt()
    {
        return $this->selectStmt;
    }

}