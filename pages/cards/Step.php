<?php



class Step implements JsonSerializable
{
    private $element;
    private $text;

    public function __construct($element, $text){
        $this->setElement($element);
        $this->setText($text);
    }

    public function setElement($element){
        $this->element = $element;
    }

    public function getElement(){
        return $this->element;
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
            "text" => $this->getText(),
            "element" => $this->getElement()->jsonSerialize()
        ];

    }

}