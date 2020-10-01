<?php

include_once('Action.php');
include_once('Enchantment.php');
include_once('Path.php');
include_once('Step.php');
include_once('Summon.php');
include_once('SummonAction.php');

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/ElementList.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Element.php');

class Card
{
    private $id;
    private $name;
    private $art;
    private $cost;
    private $element;
    private $rarity;
    private $text;
    protected $rangeType;

    public function __construct($id, $name, $art, $cost, $element, $rarity, $text){
        $this->setId($id);
        $this->setName($name);
        $this->setArt($art);
        $this->setCost($cost);
        $this->setElement($element);
        $this->setRarity($rarity);
        $this->setText($text);
        $this->rangeType = "None";
    }

    public static function loadCardsFromFile(){

        $elementList = new ElementList();

        $cards = array();

        $f = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/cards/cards.txt';
        $file = fopen($f, "r") or die("Unable to open file");

        while(!feof($file))
        {
            $type = trim(fgets($file));

            $id = trim(fgets($file));
            $name = trim(fgets($file));
            $art = trim(fgets($file));
            $cost = trim(fgets($file));
            //Load an element object corresponding to its name
            $element = $elementList->getElement(trim(fgets($file)));
            $rarity = trim(fgets($file));

            $textClauses = array();

            $clause = trim(fgets($file));

            while($clause != "End") {
                //Add text to array of lines, and add array of lines to array of clauses
                $clauseArray = array();
                $clauseArray[] = $clause;
                $textClauses[] = $clauseArray;
                $clause = trim(fgets($file));
            }


            switch($type){
                case "Action":
                    $subtype = trim(fgets($file));
                    $range = trim(fgets($file));

                    $cards[$id] = new Action ($id, $name, $art, $cost, $element, $rarity, $textClauses, $subtype, $range);
                    break;
                case "Enchantment":
                    $subtype = trim(fgets($file));
                    $range = trim(fgets($file));
                    if(!is_numeric($range) && $range != "null"){
                        $range = new AreaOfEffect($range, null);
                    }
                    $hp = trim(fgets($file));

                    $cards[$id] = new Enchantment($id, $name, $art, $cost, $element, $rarity, $textClauses, $subtype, $range, $hp);
                    break;
                case "Path":

                    $steps = Array();

                    $number = trim(fgets($file));

                    while($number != "Stop"){

                        $stepElement = trim(fgets($file));


                        $subtext  = array();

                        $line = trim(fgets($file));


                        while($line != "End"){
                            //Add line to array of lines
                            $clause = array($line);
                            $subtext[] = $clause;
                            $line = trim(fgets($file));
                        }

                        //Create a step object for each unit of step data
                        $steps[$number] = new Step($elementList->getElement($stepElement), $subtext);

                        $number = trim(fgets($file));
                    }

                    $cards[$id] = new Path($id, $name, $art, $cost, $element, $rarity, $textClauses, $steps);
                    break;
                case "Summon":
                    $hp = trim(fgets($file));
                    $movement = trim(fgets($file));
                    $range = trim(fgets($file));
                    $subtype = trim(fgets($file));

                    $subtext  = array();

                    $line = trim(fgets($file));


                    while($line != "End"){

                        //Add line to array of lines
                        $clause = array($line);
                        $subtext[] = $clause;
                        $line = trim(fgets($file));
                    }

                    $cards[$id] = new Summon($id, $name, $art, $cost, $element, $rarity, $textClauses, $hp, $movement, $range, new SummonAction($subtype, $subtext));
                    break;
                default:
                    echo "??";

            }


        fgets($file);
        }

        fclose($file);

        return $cards;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setArt($art){
            $this->art = $art;
    }

    public function getArt(){
        return $this->art;
    }

    public function setCost($cost){
            $this->cost = $cost;
    }

    public function getCost(){
        return $this->cost;
    }

    public function setElement($element){
        $this->element = $element;
    }

    public function getElement(){
        return $this->element;
    }

    public function setRarity($rarity){
        $this->rarity = $rarity;
    }

    public function getRarity(){
        return $this->rarity;
    }

    public function setText($text){
        $this->text = $text;
    }


    public function getText(){
        return $this->text;
    }


    public function rangeType(){
        return $this->rangeType;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'art' => $this->getArt(),
            'cost' => $this->getCost(),
            'element' => $this->getElement()->getName(),
            'rarity' => $this->getRarity(),
            'text' => $this->getText(),
        ];
    }
}