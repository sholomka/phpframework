<?php


namespace Application\Core;


class Venue extends DomainObject
{
    private $name;

    private $spaces;

    public function __construct($id = null, $name = null)
    {
        $this->name = $name;

        parent::__construct($id);
    }

    public function setName($name)
    {
        $this->name = $name;
    }



    public function getName()
    {
        return $this->name;
    }
}