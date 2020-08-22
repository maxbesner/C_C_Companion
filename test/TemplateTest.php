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

    protected function setUp(){
        $this->cards = Card::loadCardsFromFile();
        $this->actionTemplate = new ActionTEmplate($this->cards["A23"]);

    }
    //toggle test with test name
    function makeTemplateDirectories(){

        echo "boop";

        $elements = new ElementList();

        foreach($elements->getElements() as $element){
            foreach(CardTypes::getCardTypes() as $type){
                mkdir("C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/templateImages/".strtolower($element->getName())."/".strtolower($type),0777, true);
            }
        }

        $this->assertTrue(true);
    }


    function testCreateTemplate(){
        $this->actionTemplate->createTemplate();

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
