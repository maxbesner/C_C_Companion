<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Player.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/DeckManager.php');
session_start();

$characters = $_SESSION['user']->getCharacters();

$character = $characters[linearSearch($_GET['characterId'], $characters)];

$_SESSION['character'] = $character;

$jsonArray = createJSONArray($character);

writeJSONFile($jsonArray);

echo true;







function writeJSONFile($jsonArray){

    $file = $_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/player.json';

    file_put_contents($file, "");

    $current.= "[\n".json_encode($jsonArray)."\n]";

    file_put_contents($file, $current);

}

function createJSONArray($character){

    $decks = $character->getDecks();

    $array = {
        'name' => $character->getName();
        'deck' => $decks[linearSearch($_GET['deckId'], $decks)];
    }
}

function linearSearch($id, $array){

    foreach($array as $object){

        if($object->getId() == $id){
            return array_keys($array, $object)[0];
        }
    }

    return null;
}

function binarySearch($id, $array) {

    $start = 0;
    $end = count($array);

    while ($start <= $end) {

        $mid = floor(($start + $end) / 2);

        $objId = $array[$mid]->getId();

        if ($objId == $id) {
            return $mid;
        }

        if ($objId < $id) {
            $start = $mid + 1;
        } else {
            $end = $mid - 1;
        }
    }
    return -1;
}
