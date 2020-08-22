<?php


class SummonAction
{

    private $subtype;
    private $text;

    public function __construct($subtype, $text){

        $this->setSubtype($subtype);
        $this->setText($text);
    }

    public function setSubtype($subtype){
        $this->subtype = $subtype;
    }

    public function getSubtype(){
        return $this->subtype;
    }

    public function setText($text){
        $this->text = $text;
    }

    public function getText(){
        return $this->text;
    }

}