<?php


use PHPUnit\Framework\TestCase;

class InitiativeTest extends TestCase
{
    private $nonInitiativePlayers;
    private $initiativePlayers;

    protected function setUp(){
        $this->initiativePlayers =  Array("Steph", "Klay");
        $this->nonInitiativePlayers = Array("Me", "Kyrie", "Lebron");
    }

    function testInitiative(){


        $this->nonInitiativePlayers = $this->shuffle($this->nonInitiativePlayers);

        $turnOrder = $this->mergeArrays($this->initiativePlayers, $this->nonInitiativePlayers);

        print_r($turnOrder);
        $this->assertTrue(true);
    }

    function shuffle($array){
        $size = count($array);
        for($i = 0; $i < $size; $i++){
            $array = $this->swap($array, $i, rand(0, $i));
        }

        return $array;
    }

    function mergeArrays($array1, $array2){
        $merged = array();

        foreach($array1 as $element){
            $merged[] = $element;
        }

        foreach($array2 as $element){
            $merged[] = $element;
        }

        return $merged;
    }

    function swap($array, $index1, $index2){
        $temp = $array[$index1];

        $array[$index1] = $array[$index2];

        $array[$index2] = $temp;

        return $array;
    }

}
