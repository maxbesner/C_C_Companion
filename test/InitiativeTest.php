<?php


use PHPUnit\Framework\TestCase;

class InitiativeTest extends TestCase
{
    private $nonInitiativePLayers;
    private $initiativePlayers;

    protected function setUp(){
        $this->initiativePlayers =  Array("Steph", "Klay");
        $this->nonInitiativePLayers = Array("Me", "Kyrie", "Lebron");
    }

    function testInitiative(){


        $size = count($this->nonInitiativePLayers);
        for($i = 0; $i < $size; $i++){
            $this->nonInitiativePLayers = $this->swap($this->nonInitiativePLayers, $i, rand(0, $size - 1));
        }

        $turnOrder = $this->mergeArrays($this->initiativePlayers, $this->nonInitiativePLayers);

        print_r($turnOrder);
        $this->assertTrue(true);
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
