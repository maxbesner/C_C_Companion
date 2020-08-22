<?php

include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/ActionTemplate.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/Card.php');

class TemplateTest extends PHPUnit\Framework\TestCase
{


   function testGetTextBox(){
        $cards = Card::loadCardsFromFile();

        $card = $cards["A23"];


        $actionTemplate = new ActionTemplate($card);

        $actionTemplate->createTextBox();

        $this->assertTrue(true);
    }
}
