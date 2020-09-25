<?php


use PHPUnit\Framework\TestCase;

class JSONTest extends TestCase
{

    protected $cards;

    function setUp(){
        $this->cards = Card::loadCardsFromFile();


    }



    function testMakeJSON(){

        $file =$_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/cards/cards.json';

        file_put_contents($file, "");
        $current = file_get_contents($file);

        $current.= "[\n";

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

        file_put_contents($file, $current);

        $this->assertTrue(true);
    }



    function /*test*/DecodeJSON(){

        $file =$_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/cards/cards.json';

        $current = file_get_contents($file);

        var_dump(json_decode($current));

        $this->assertTrue(true);
    }

}
