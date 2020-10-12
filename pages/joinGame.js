function createDeckDropdown(characterId){
    alert(characterId);
   /* let characterDecks = decksByCharacterId.get(characterId);
    for(characterDeck in characterDecks){
        let deckIdentifier = characterDeck.id;

        if(characterDeck.name !== null){
            deckIdentifier += ": " + characterDeck.name;
        }

        document.getElementById("deckDropdownMenu").innerHTML += '<a id="deck' + characterDeck.id + '" class="dropdown-item" action="updateDropdownHeader(' + deckIndentifier + ')">' + deckIdentifier + '</a>';
    }

    document.getElementById("deckDropdown").hidden = false;*/

}

function updateDropdownHeader(deckIdentifier){
    document.getElementById("deckDropdownMenuButton").innerHTML = deckIndentifier;
}