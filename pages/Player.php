<?php


class Player
{
    private $id;
    private $name;
    private $hp;

    function __construct($id, $name){
        $this->setId($id);
        $this->setName($name);
        $this->setHP(30);
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }
    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }

    function setHP($hp){
        $this->hp = $hp;
    }

    function getHP(){
        return $this->hp;
    }

    function incrementHP(){
        $this->hp++;
    }

    function decrementHP(){
        $this->hp--;
    }
}