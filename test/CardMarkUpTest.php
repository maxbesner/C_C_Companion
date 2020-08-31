<?php

include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/ActionTemplate.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/templates/EnchantmentTemplate.php');

include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/Card.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/ElementList.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/Element.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/cards/CardTypes.php');

class CardMarkUpTest extends PHPUnit\Framework\TestCase
{


    protected $actionTemplate;
    protected $cards;
    protected $actionTemplates = array();
    protected $enchantmentTemplates = array();

    protected $templates = array();



    protected function setUp(){

        /*
         * foreach(CardTypes::getCardTypes() as $cardType){
         *      $templates[$cardType] = array();
         * }
         */
        $this->cards = Card::loadCardsFromFile();

        foreach($this->cards as $card){
            if(get_class($card) == "Action"){
                $this->actionTemplates[] = new ActionTemplate($card);
            }

            if(get_class($card) == "Enchantment"){
                $this->enchantmentTemplates[] = new EnchantmentTemplate($card);
            }


        }

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


    function testCreateAction(){

        foreach($this->actionTemplates as $template){
            $template->createCard();
        }

        $this->assertTrue(true);
    }

    function testCreateEnchantment(){
        foreach($this->enchantmentTemplates as $template){
            $template->createCard();
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