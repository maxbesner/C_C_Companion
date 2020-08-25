<?php

include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/ActionTemplate.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/Card.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/ElementList.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/Element.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/CardTypes.php');

class TemplateTest extends PHPUnit\Framework\TestCase
{


    protected $actionTemplate;
    protected $cards;
    protected $actionTemplates = array();

    protected function setUp(){
        $this->cards = Card::loadCardsFromFile();

        foreach($this->cards as $card){
            if(get_class($card) == "Action"){
                $this->actionTemplates[] = new ActionTemplate($card);
            }
        }
    }

    function testMakeJSON(){

        $file ='C:/xampp/htdocs/CharacterBuilder/pages/cards/cards.json';

        file_put_contents($file, "");
        $current = file_get_contents($file);

        foreach($this->cards as $card){
            $current .= json_encode($card)."\n\n";
        }

        file_put_contents($file, $current);

        $this->assertTrue(true);
    }

    function /*test*/DecodeJSON(){

        $file ='C:/xampp/htdocs/CharacterBuilder/pages/cards/cards.json';

        $current = file_get_contents($file);

        var_dump(json_decode($current));

        $this->assertTrue(true);
    }

    //toggle test with test name
    function makeTemplateDirectories(){
        $elements = new ElementList();

        foreach($elements->getElements() as $element){
            foreach(CardTypes::getCardTypes() as $type){
                mkdir("C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/".strtolower($element->getName())."/".strtolower($type),0777, true);
            }
        }

        $this->assertTrue(true);
    }


    function testCreateTemplate(){

        foreach($this->actionTemplates as $template){
            $template->createTemplate();
        }

        $this->assertTrue(true);
    }

   function GetTextBox(){
        $cards = Card::loadCardsFromFile();

        $card = $cards["A23"];


        $actionTemplate = new ActionTemplate($card);

        $actionTemplate->createTextBox();

        $this->assertTrue(true);
    }



}
