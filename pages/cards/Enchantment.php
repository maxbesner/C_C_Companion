<?php

include_once('Card.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/cards/Subtyped.php');

class Enchantment extends Card implements JsonSerializable, Subtyped
{


    private $subtype;
    private $range;
    private $hp;

    public function __construct($id, $name, $art, $cost, $element, $rarity, $text,  $subtype,$range, $hp){
        parent::__construct($id, $name, $art, $cost, $element, $rarity, $text);
        $this->setRange($range);
        $this->setSubtype($subtype);
        $this->setHP($hp);
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

    public function setHP($hp){
        $this->hp = $hp;
    }

    public function getHP(){
        return $this->hp;
    }

    function jsonSerialize()
    {
        $array = parent::jsonSerialize();

        $array['range'] = $this->getRange();
        $array['subtype'] = json_encode($this->getSubtype());
        $array['hp'] = $this->getHP();

        return $array;
    }


}