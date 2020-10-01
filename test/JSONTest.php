<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/C&C_Companion/pages/cards/Card.php');

use PHPUnit\Framework\TestCase;

class JSONTest extends TestCase
{

    protected $cards;

    function setUp(){
        $this->cards = Card::loadCardsFromFile();


    }



    function testMakeJSON(){

        //The directory of the file being written to
        $file = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/cards.json';

        //Clear file contents and set current file text string to be equa to it
        file_put_contents($file, "");
        $current = file_get_contents($file);

        $current.= "[\n";

        //Check whether the first object has been encoded so that only the first object
        //has no comma in front of it
        $started = false;
        foreach($this->cards as $card){
            if($started){
                $current .= ",\n\n\t".json_encode($card);
            }else{
                $current.= "\t".json_encode($card);
                $started = true;
            }

        }

        $current.= "\n]";

        //Set the file's contents to be equal to the constructed string
        file_put_contents($file, $current);

        $this->assertTrue(true);
    }



    function testDecodeJSON(){

        $file =$_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/cards.json';

        $current = file_get_contents($file);

        var_dump(json_decode($current));

        $this->assertTrue(true);
    }

}
