<?php

include_once('Action.php');
include_once('Card.php');
include_once('Enchantment.php');
include_once('Path.php');
include_once('Step.php');
include_once('Summon.php');
include_once('SummonAction.php');
include_once('header.php');
include_once('./templates/ActionTemplate.php');

function createNumericallyIndexedArray($array){
    $numArray = array();

    foreach($array as $element){
        $numArray[] = $element;
    }

    return $numArray;
}

function displayCard($card){
    ?>
    <img src="cardImages/<?php echo $card->getId()?>.jpg" alt ="<?php echo $card->getName()?>">
    <br>

    <?php

}

   function displayCardRow($cards, $index){?>
        <?php
        for($i = $index; $i < $index + 3; $i++){
            if($i == count($cards)) {
                return true;
            }
            $card = $cards[$i];
            ?>
                <img style="display: inline; margin: 0 5px;" src="cardImages/<?php echo $card->getId()?>.jpg" alt ="<?php echo $card->getName()?>">
            <?php
        }
        ?>

<?php
echo '<br>';
return false;
}

?>
    <html lang="en">
        <head>
            <link rel="stylesheet" href="/css/bootstrap.css">
            <link rel="stylesheet" href="/css/style.css">

            <title>Cards</title>
        </head>

<?php
    $index = 0;
    $cards= Card::loadCardsFromFile();

    $cards = createNumericallyIndexedArray($cards);
    $finished = false;

    while(!$finished) {
    $finished = displayCardRow($cards, $index);
    $index += 3;
    }
?>
    </html>

