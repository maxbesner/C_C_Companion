<?php


class cardEnvironment
{
    private $deck = array();

    private $hand = array();

    private $discardPile = array();

    public function setDeck($deck){
        $this->deck = $deck;
    }

    public function getDeck(){
        return $this->deck;
    }

    public function drawCard(){
        $this->hand[] = array_splice($this->deck, count($this->deck) - 1, 1)[0];
    }

    public function discardCard($index){
        $this->discardPile[] = array_splice($this->hand, $index, 1)[0];
    }

    public function removeFromHand($index){
        return array_splice($this->hand, $index, 0)[0];
    }

    public function drawFive(){
        for($i = 0; $i < 5; $i++){
            $this->drawCard();
        }
    }

    public function addToHand($card){
        $this->hand[] = $card;
    }

    public function addToDeck($card){
        $this->deck[] = $card;
    }

    public function addToDiscard($card){
        $this->discardPile[] = $card;
    }

    public function shuffleDiscardIntoDeck(){
        array_merge($this->deck, array_splice($this->discardPile, 0));

        shuffle($this->deck);
    }
}