let players = new Map();

let initiative = [];

let nonInitiative = [];

function start() {

    setPlayers();
    newTurn();
}

function addToInitiative(playerId) {
    if (players.size === 0 || linearSearch(initiative, playerId) !== -1) return;

    initiative.push(nonInitiative.splice(linearSearch(nonInitiative, playerId), 1)[0]);

    writeInitiative(initiative);
}

function removeFromInitiative(playerId) {

    if (players.size === 0) return;

    let index = linearSearch(initiative, playerId);
    if (index === -1) {
        return;
    }
    nonInitiative.push(initiative.splice(index, 1)[0]);

    writeInitiative(initiative);
}

function newTurn() {
    if (players.size === 0) return;

    let turnOrder = mergeArrays(initiative, shuffle(nonInitiative));

    writeTurnOrder(turnOrder)

    initiative = [];

    writeInitiative(initiative);
}

function writeTurnOrder(turnOrder) {
    document.getElementById("turnOrder").innerHTML = "Turn Order";

    for (let i = 0; i < turnOrder.length; i++) {
        document.getElementById("player" + i).innerHTML = turnOrder[i].name;
    }
}

function writeInitiative(initiativeArray) {

    document.getElementById("initiative").innerHTML = "Initiative";

    resetInitiativeHTML();

    for (let i = 0; i < initiativeArray.length; i++) {
        document.getElementById("player" + i + "Initiative").innerHTML = initiativeArray[initiativeArray.length - 1 - i].name;
    }
}

function resetInitiativeHTML() {
    for (let i = 0; i < players.size; i++) {
        document.getElementById("player" + i + "Initiative").innerHTML = "";
    }
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

function mergeArrays(array1, array2) {

    let mergedArray = [];

    for (let i = array1.length - 1; i >= 0; i--) {
        mergedArray.push(array1[i]);
    }

    for (let i = array2.length - 1; i >= 0; i--) {
        mergedArray.push(array2[i]);
    }

    return mergedArray;
}


function copyArray(array) {
    let copy = [];

    for (let i = 0; i < array.length; i++) {
        copy[i] = array[i];
    }

    return copy;
}


function linearSearch(array, playerId) {
    for (let i = 0; i < array.length; i++) {

        if (playerId === array[i].id) {

            return i;
        }
    }

    return -1;
}

function binarySearch(array, playerId) {

    let start = 0;
    let end = array.length;

    while (start <= end) {
        let mid = Math.floor((start + end) / 2)

        let player = array[mid];

        if (player.id === playerId) {
            return mid;
        }

        if (player.id < playerId) {
            start = mid + 1;
        } else {
            end = mid - 1;
        }
    }
    return -1;
}

function setPlayers() {
    for (let i = 0; i < playerNames.length; i++) {
        let player = {id: i, name: playerNames[i], hp: 30};
        players.set(i,player);
        nonInitiative[i] = player;
    }

}

function incrementHPBy5(playerId) {
    for (let i = 0; i < 5; i++) {
        incrementHP(playerId);
    }
}

function incrementHP(playerId) {
    let hp = parseInt(document.getElementById(playerId + "hp").value);

    if (!Number.isInteger(hp)) {
        document.getElementById(playerId + "hp").value = ++players.get(playerId).hp;

    } else {
        players.get(playerId).hp = ++hp;
        document.getElementById(playerId + "hp").value = hp;
    }
}

function decrementHPBy5(playerId) {
    for (let i = 0; i < 5; i++) {
        decrementHP(playerId);
    }
}

function decrementHP(playerId) {

    let hp = parseInt(document.getElementById(playerId + "hp").value);

    if (!Number.isInteger(hp)) {
        document.getElementById(playerId + "hp").value = --players.get(playerId).hp;

    } else {
        players.get(playerId).hp = --hp;
        document.getElementById(playerId + "hp").value = hp;
    }
}

