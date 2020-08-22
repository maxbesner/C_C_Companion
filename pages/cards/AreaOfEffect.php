<?php


class AreaOfEffect
{
    private $name;
    private $image;

     function __construct($name, $image){
         $this->setName($name);
         $this->setImage($image);
     }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function getArt(){
        return $this->image;
    }


}