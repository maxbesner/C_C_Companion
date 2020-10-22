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

        deckDropdownHTML += "<a id=\"deck"+ characterDeck.id + "\" class=\"dropdown-item\" onclick=\"updateButtonHeader('" +  deckDropdownMenuButton + "', '" + deckIdentifier + "')\">" + deckIdentifier + "</a>\n";

    }

    updateButtonHeader("characterDropdownMenuButton", characterId + ": " + characterName);
    document.getElementById("deckDropdownMenu").innerHTML = deckDropdownHTML;
    document.getElementById("deckDropdown").hidden = false;

}

function updateButtonHeader(buttonId, text){
    document.getElementById(buttonId).textContent = text;
}


function joinGame(){

    let characterId = validateAndGetId("character");

    if(characterId == null){
        return;
    }

    let deckId = validateAndGetId("deck");

    if(deckId == null){
        return;
    }

    let urlString = "joinGameAjax.php?characterId=" + characterId + "&deckId=" + deckId;
    $.ajax({
        url: urlString,//the page containing php script
        type: "GET", //request type
        success:function(result){
            if(result == true){
                window.location.href="gameSpace.php";
            }
        }
    });
}

function validateAndGetId(inputType){
    let id = document.getElementById(inputType + "DropdownMenuButton").textContent.substr(0, 7);

    lowerCaseId = id.toLowerCase();

    if(lowerCaseId.charAt(0) != inputType.charAt(0)){
        alert("Please choose a " + inputType);
        return null;
    }


    return id;
}
