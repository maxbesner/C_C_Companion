<?php

include_once('Card.php');
include_once("C:/xampp/htdocs/CharacterBuilder/pages/cards/Subtyped.php");

class Action extends Card implements JsonSerializable, Subtyped
{

    private $subtype;
    private $range;

    public function __construct($id, $name, $art, $cost, $element, $rarity, $text, $subtype, $range){
        parent::__construct($id, $name, $art, $cost, $element, $rarity, $text);
        $this->setSubtype($subtype);
        $this->setRange($range);
    }

    public function setSubtype($subtype){
        $this->subtype = $subtype;
    }

    public function getSubtype(){
        return $this->subtype;
    }

    public function setRange($range){
        $this->range = $range;

        if(!is_string($range) && get_class($range) == "AreaOfEffect"){
            $this->rangeType = "AOE";
        }
        else if(is_numeric($range)){
            $this->rangeType = "Range";
        }
        else{
            $this->rangeType = "None";
        }
    }

    public function getRange(){
        return $this->range;
    }

    function jsonSerialize()
    {
        $array = parent::jsonSerialize();

        $array['range'] = $this->getRange();
        $array['subtype'] = $this->getSubtype();

        return $array;
    }

}