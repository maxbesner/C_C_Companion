function createDeckDropdown(characterId){
    let characterDecks = decksByCharacterId.get(characterId);
    let deckDropdownHTML = "";
    let deckIdentifier;
    for(characterDeck in characterDecks){
        deckIdentifier = characterDeck.id;

        if(characterDeck.name !== null){
            deckIdentifier += ": " + characterDeck.name;
        }

        deckDropdownMenuHTML += '<a id="deck' + characterDeck.id + '" class="dropdown-item" onclick="updateDropdownHeader(' + deckIndentifier + ')">' + deckIdentifier + '</a>';

    }

    alert(deckDropdownHTML);
    document.getElementById("deckDropdownMenu").innerHTML = deckDropdownHTML;
    document.getElementById("deckDropdown").hidden = false;

}

function updateDropdownHeader(deckIdentifier){
    document.getElementById("deckDropdownMenuButton").innerHTML = deckIndentifier;
}