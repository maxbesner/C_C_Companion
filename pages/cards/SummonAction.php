<?php


class SummonAction implements JsonSerializable
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

    public function jsonSerialize()
    {
        return [
            'subtype' => $this->getSubtype(),
            'text' => $this->getText()
        ];
        // TODO: Implement jsonSerialize() method.
    }
}