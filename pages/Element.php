<?php


class Element
{
    private $name;
    private $description;
    private $colour;

    public function __construct($name, $description, $colour)
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setColour($colour);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setColour($colour)
    {
        $this->colour = $colour;
    }

    public function getColour()
    {
        return $this->colour;
    }

    public function equals($name)
    {
        return $name == $this->getName();
    }


}