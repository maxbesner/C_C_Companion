<?php

include_once('./cards/Action.php');
include_once('./cards/Card.php');
include_once('./cards/Enchantment.php');
include_once('./cards/Path.php');
include_once('./cards/Step.php');
include_once('./cards/Summon.php');
include_once('./cards/SummonAction.php');
include_once('./cards/templates/ActionTemplate.php');

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

function displayCardRow($cards, $index, $cardsPerRow){?>
    <?php
    for($i = $index; $i < $index + $cardsPerRow; $i++){
        if($i == count($cards)) {
            return true;
        }
        $card = $cards[$i];
        ?>
            <img style="display: inline; margin: 0 5px;" src="./cards/cardImages/<?php echo $card->getId()?>.jpg" alt ="<?php echo $card->getName()?>" width="225" height="315">
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

    include_once($_SERVER['DOCUMENT_ROOT'].'/C&C_Companion/pages/header.php');
    $index = 0;
    $cards= Card::loadCardsFromFile();

    $cards = createNumericallyIndexedArray($cards);
    $finished = false;

    $cardsPerRow= 3;
    while(!$finished) {
        $finished = displayCardRow($cards, $index, $cardsPerRow);
        $index += $cardsPerRow;
    }

include_once($_SERVER['DOCUMENT_ROOT'].'/C&C_Companion/pages/footer.php');
?>

    </html>

