<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23.05.2017
 * Time: 14:35
 */

namespace Application\Core;


abstract class DomainObject
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public static function getCollection($type)
    {
        return [];
    }

    public function collection()
    {
        return self::getCollection(get_class($this));
    }
}