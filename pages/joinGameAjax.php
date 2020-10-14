<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Player.php');

session_start();

$characters = $_SESSION['user']->getCharacters();

$character = $characters[binarySearch($_GET['characterId'], $characters)];

$_SESSION['character'] = $character;

$decks = $character->getDecks();

$_SESSION['deck'] = $decks[binarySearch($_GET['deckId'], $decks)];

echo "boop";

header('Location:gameSpace.php');

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
