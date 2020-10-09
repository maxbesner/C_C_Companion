<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/C&C_Companion/pages/cards/Card.php');
class DeckManager
{
    private $allCards = array();

    private $cardPool = array();

    private $deck = array();

    private $hand = array();

    function __construct(){
        $this->allCards = Card::loadCardsFromFile();
    }

    public function setCardPool($cardPool){
        $this->cardPool = $cardPool;
    }

    public function getCardPool(){
        return $this->cardPool;
    }

    public function setMaxCardPool(){
        foreach($this->allCards as $card){
            $this->cardPool[$card->getId] = 3;
        }
    }

    public function setDeck($deck){
        $this->deck = $deck;
    }

    public function getDeck(){
        return $this->deck;
    }

    public function addCardToDeck($card){
        if($this->cardPool[$card->getId()] == 0){
            return false;
        }

        $this->deck[] = $card;
        $this->cardPool[$card->getId()]--;

        return true;
    }

    public function removeCardFromDeck($card){

        $index = array_search($card, $this->deck);
        if($index != false){
            array_splice($this->deck, $index, 1);
            $this->cardPool[$card->getId()]++;

            return true;
        }

        return false;
    }
}