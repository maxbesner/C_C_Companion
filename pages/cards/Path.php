<?php

include_once('Card.php');
include_once('Step.php');

class Path extends Card implements JsonSerializable
{
    private $steps = Array();

    public function __construct($id, $name, $art, $cost, $element, $rarity, $text, $steps){
        parent::__construct($id, $name, $art, $cost, $element, $rarity, $text);
        $this->setSteps($steps);
    }

    public function setSteps($steps){
        $this->steps = $steps;
    }

    public function getSteps(){
        return $this->steps;
    }

    function jsonSerialize()
    {
        $array = parent::jsonSerialize();

        $array['steps'] = json_encode($this->getSteps());

        return $array;
    }

}

