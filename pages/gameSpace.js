let hand = [];
let discardPile = [];

function confirmDiscard(imageIndex){
    if(confirm("Would you like to discard this card?")){
        discard(imageIndex);
    }
}

function discard(imageIndex){
    discardPile.push(hand.splice(imageIndex, 1));

    markupHand();
    markupDiscard();
}

function binarySearch(array, cardId) {

    let start = 0;
    let end = array.length;

    while (start <= end) {
        let mid = Math.floor((start + end) / 2)

        let id = array[mid];
        
        if (id == cardId) {
            return mid;
        }

        if (id < cardId) {
            start = mid + 1;
        } else {
            end = mid - 1;
        }
    }
    return -1;
}

function markupHand(){
    for(let i = 0; i < deckMaxLength; i++){
        let imageId = "cardInHand" + i;
        if(i < hand.length){
            markupCard(hand[i], i);
        }
        else{
            document.getElementById(imageId).hidden = true;
        }
    }
}

function markupCard(cardId, index){
    let imageId = "cardInHand" + index;

    document.getElementById(imageId).src = cardId;
    document.getElementById(imageId).hidden = false;
}

function markupDeck(){
    if(deck.length == 0){
        document.getElementById("deck").alt = "emptyDeck";
    }else
    {
        document.getElementById("deck").alt = "deck";
    }
}

function markupDiscard(){
    if(discardPile.length > 0){
        document.getElementById("discardPile").src = discardPile[discardPile.length - 1];
        document.getElementById("discardPile").hidden = false;
    }else{
        document.getElementById("discardPile").hidden = true;
    }
}

function drawCard(){
    if(deck.length == 0){
        shuffleDiscardIntoDeck();
    }

    hand.push(deck.pop());

    markupCard(hand[hand.length - 1], hand.length - 1);
    markupDeck();
}

function shuffleDiscardIntoDeck(){
    deck = deck.concat(shuffle(discardPile.splice(0, discardPile.length)));

    resetSpace();
}

function shuffle(array) {
    let size = array.length;
    for (let i = 0; i < size; i++) {

        let randomIndex = i + 1;

        while (randomIndex === i + 1) {
            randomIndex = Math.floor(Math.random() * (i + 1));
        }

        array = swap(array, i, randomIndex);
    }

    return array;
}

function swap(array, index1, index2) {
    let temp = array[index1];

    array[index1] = array[index2];

    array[index2] = temp;

    return array;
}

function resetSpace(){
    markupHand();
    markupDiscard();
    markupDeck();
}