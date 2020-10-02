<?php


class Element
{
    private $name;
    private $symbol;
    private $description;
    private $colour;

    public function __construct($name, $symbol, $description, $colour)
    {
        $this->setName($name);
        $this->setSymbol($symbol);
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

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbol()
    {
        return $this->symbol;
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