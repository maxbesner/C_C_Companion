<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/ActionTemplate.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/EnchantmentTemplate.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/SummonTemplate.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/Path3Template.php');


include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/Card.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/ElementList.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Element.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/CardTypes.php');

class CardMarkUpTest extends PHPUnit\Framework\TestCase
{


    protected $actionTemplate;
    protected $cards;

    protected $actionTemplates = array();
    protected $enchantmentTemplates = array();
    protected $summonTemplates = array();
    protected $pathTemplates = array();

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

            if(get_class($card) == "Summon"){
                $this->summonTemplates[] = new SummonTemplate($card);
            }

            if(get_class($card) == "Path"){
                $this->pathTemplates[] = new Path3Template($card);
            }

        }




    }




    //toggle test with test name
    function makeTemplateDirectories(){
        $elements = new ElementList();

        foreach($elements->getElements() as $element){
            foreach(CardTypes::getCardTypes() as $type){
                mkdir($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/templates/templateImages/'.strtolower($element->getName())."/".strtolower($type),0777, true);
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

    function CreateSummon(){
        foreach($this->summonTemplates as $template){
            $template->createCard();
        }

        $this->assertTrue(true);
    }

    function testCreatePath3(){
        foreach($this->pathTemplates as $template){
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
