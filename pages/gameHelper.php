<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/pages/Player.php');


$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title = "Character Creation";
include_once('header.php');



$playerNames = Array("Steph", "Klay", "Me", "Kyrie", "Lebron");
$players = getPlayers($playerNames);

?>

<script>
    let playerNames = <?php echo json_encode($playerNames)?>;
</script>
<script src="gameHelper.js">
</script>

<h3>Players</h3>

<?php



writePlayers($players);

writeEmptyInitiative($players);

writeEmptyTurnOrder($players);

?>
<button onclick="start()">Start</button><button onclick="newTurn()">New Turn</button>

<?php

include_once('footer.php');

function getPlayers($playerNames){
    $players = Array();

    for($i = 0; $i<count($playerNames); $i++){
        $players[$i] = new Player($i, $playerNames[$i]);
    }

    return $players;
}

function writePlayers($players){
    foreach($players as $player){
        ?>
        <h3><?php echo $player->getName()?></h3>
        <div>HP: <label for="<?php echo $player->getId().'hp'?>"></label><input type="text" id="<?php echo $player->getId().'hp'?>" value="<?php echo $player->getHP()?>"><button onclick="decrementHPBy5(<?php echo $player->getId()?>)">-5</button><button onclick="decrementHP(<?php echo $player->getId()?>)">-1</button><button onclick="incrementHP(<?php echo $player->getId()?>)">+1</button><button onclick="incrementHPBy5(<?php echo $player->getId()?>)">+5</button></div>
        <br>
        <button onclick="addToInitiative(<?php echo $player->getId()?>)">Gain Initiative</button><button onclick="removeFromInitiative(<?php echo $player->getId()?>)">ResetInitiative</button>
        <?php
    }
}

function writeEmptyTurnOrder($players){
    echo '<div id="turnOrder"></div>';
    for($i = 0; $i < count($players); $i++){
        ?>
        <div id="player<?php echo $i?>"></div>
        <br>
        <?php
    }
}

function writeEmptyInitiative($players){
    echo '<div id="initiative"></div>';
    for($i = 0; $i < count($players); $i++){
        ?>
        <div id="player<?php echo $i.'Initiative'?>"></div>
        <br>
        <?php
    }
}

?>

