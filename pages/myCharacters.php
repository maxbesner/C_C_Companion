<?php

include_once('SessionManager.php');
include_once('../user/User.php');
include_once('../user/Character.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$user = $_SESSION['user'];

$page_title = "My Characters";
include_once('header.php');

//Get array of all characters belonging to user
$characters = $user->getCharacters();

echo '<table border=\'1\'>';

//Create a table of consisting of the characters
foreach($characters as $character)
{
    echo '<tr>';
    echo '<td><a href=\'characterInfo.php?id='.$character->getId().'\'>'.$character->getName().'</a></td>';
    echo '</tr>';
}


include_once('footer.php');

