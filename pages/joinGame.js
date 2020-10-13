function createDeckDropdown(characterId, characterName){

    characterDecks = decksByCharacterId.get(characterId);
    let deckDropdownHTML = "";
    let deckIdentifier = "";
    for(let i = 0; i < characterDecks.length; i++){

        characterDeck = characterDecks[i];

        deckIdentifier = characterDeck.id;

        if(characterDeck.name != null){
            deckIdentifier += ": " + characterDeck.name;
        }

        deckDropdownMenuButton = "deckDropdownMenuButton";

        deckDropdownHTML += "<a id=\"deck"+ characterDeck.id + "\" class=\"dropdown-item\" onclick=\"updateDropdownHeader(\"" +  deckDropdownMenuButton + "\", \"" + deckIdentifier + "\")\">" + deckIdentifier + "</a>\n";

    }


    updateButtonHeader("characterDropdownMenuButton", characterId + ": " + characterName);
    document.getElementById("deckDropdownMenu").innerHTML = deckDropdownHTML;
    document.getElementById("deckDropdown").hidden = false;

}

function updateButtonHeader(buttonId, text){
    document.getElementById(buttonId).textContent = text;
}