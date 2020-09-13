<?php

include_once('Card.php');
include_once('SummonAction.php');

class Summon extends Card
{
    private $hp;
    private $movement;
    private $range;
    private $action;


    public function __construct($id, $name, $art, $cost, $element, $rarity, $text, $hp, $movement, $range, $action){
        parent::__construct($id, $name, $art, $cost, $element, $rarity, $text);
        $this->setHP($hp);
        $this->setMovement($movement);
        $this->setRange($range);
        $this->setAction($action);
    }

    public function setHP($hp){
        $this->hp = $hp;
    }

    public function getHP(){
        return $this->hp;
    }

    public function setMovement($movement){
        $this->movement = $movement;
    }

    public function getMovement(){
        return $this->movement;
    }

    public function setRange($range){
        $this->range = $range;
    }

    public function getRange(){
        return $this->range;
    }



    public function setAction($action){
        $this->action = $action;
    }

    public function getAction(){
        return $this->action;
    }


    function jsonSerialize()
    {

        $array = parent::jsonSerialize();

        $array['hp'] = $this->getHP();
        $array['movement'] = $this->getMovement();
        $array['range'] = $this->getRange();
        $array['action'] = json_encode($this->getAction());

        return $array;
    }


}