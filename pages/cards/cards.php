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

function loadCardsFromFile()
{
    $cards = array();

    $f = "C:/xampp/htdocs/CharacterBuilder/pages/cards/cards.txt";
    $file = fopen($f, "r") or die("Unable to open file");

    while(!feof($file))
    {
        $type = trim(fgets($file));

        $id = trim(fgets($file));
        $name = trim(fgets($file));
        $art = trim(fgets($file));
        $cost = trim(fgets($file));
        $element = trim(fgets($file));
        $rarity = trim(fgets($file));

        $textClauses = array();

        $clause = trim(fgets($file));

        while($clause != "End") {
            $clauseArray = array();
            $clauseArray[] = $clause;
            $textClauses[] = $clauseArray;
            $clause = trim(fgets($file));

        }


        switch($type){
            case "Action":
                $subtype = trim(fgets($file));
                $range = trim(fgets($file));

                $cards[$id] = new Action ($id, $name, $art, $cost, $element, $rarity, $textClauses, $subtype, $range);
                break;
            case "Enchantment":
                $subtype = trim(fgets($file));
                $range = trim(fgets($file));
                if(!is_numeric($range) && $range != "null"){
                    $range = new AreaOfEffect($range, null);
                }
                $hp = trim(fgets($file));

                $cards[$id] = new Enchantment($id, $name, $art, $cost, $element, $rarity, $textClauses, $subtype, $range, $hp);
                break;
            case "Path":

                $steps = Array();

                $number = trim(fgets($file));

                while($number != "Stop"){

                    $element = trim(fgets($file));


                    $subtext = "";

                    $clause = trim(fgets($file));

                    while($clause != "End"){

                        $subtext .= $clause."\n";

                        $clause = trim(fgets($file));
                    }


                    $steps[$number] = new Step($element, $subtext);

                    $number = trim(fgets($file));
                }

                $cards[$id] = new Path($id, $name, $art, $cost, $element, $rarity, $textClauses, $steps);
                break;
            case "Summon":
                $hp = trim(fgets($file));
                $movement = trim(fgets($file));
                $subtype = trim(fgets($file));

                $subtext  = "";

                $clause = trim(fgets($file));

                while($clause != "End"){

                    $subtext .= $clause;

                    $clause = trim(fgets($file));
                }

                $cards[$id] = new Summon($id, $name, $art, $cost, $element, $rarity, $textClauses, $hp, $movement, new SummonAction($subtype, $subtext));
                break;
            default:
                echo "WTF??";

        }


        fgets($file);
    }

    fclose($file);

    return $cards;
}

function printStep($step){
    ?>
       <p><?php echo $step->getElement().": ".$step->getText()?></p>
    <?php
}

function printCard($card){

    ?>

    <html lang="en">



    <!--Make a Magic: the Gathering Card in CSS by Davide Iaiunese consulted-->
    <div class="card-container">
        <div class="card-background">
            <div class="card-frame">
                <div class="frame-header">
                    <h1 class="name"><?php echo $card->getName()?></h1>
                    <span id="mana-icon"><?php echo $card->getCost()?></span>
                </div>

                <!-- Here goes the art-->
                <img class="frame-art" src="<?php echo $card->getArt()?>" alt="art">


                <div class="frame-type-line">
                    <h1 class="type">
                        <?php

                        $type = get_class($card);
                        echo $type;

                        if($type == "Action" || $type == "Enchantment"){
                            echo " - ".$card->getSubtype();
                        }
                         ?>
                    </h1>
                    <!-- potential set icon/rarity here -->
                </div>

                <div class="frame-text-box">
                    <p class="card-text-1"><?php if($card->getText() != "null"){echo $card->getText();}?></p>

                    <?php

                    if($type == "Path"){
                        foreach ($card->getSteps() as $step){
                            printStep($step);
                        }
                    }
                    else if($card->rangeType() == "Range"){
                        ?>
                        <p class="range">Range: <?php echo $card->getRange()?></p>
                        <?php
                    }
                    else if ($card->rangeType() == "AOE"){
                        ?>
                        <p class="range">AOE: <?php echo $card->getRange()->getName()?></p>
                        <?php
                    }

                    if($type == "Enchantment" || $type == "Summon"){
                        ?>
                        <p class="hp">HP: <?php echo $card->getHP()?></p>
                        <?php
                    }

                    if($type == "Summon"){
                        ?>
                        <p class="movement">Movement: <?php echo $card->getMovement()?></p>
                        <?php if($card->getAction()->getText() != "null"){echo '<br>'.$card->getAction()->getSubtype().': <br>'.$card->getAction()->getText();}?>
                        <?php
                    }



                    ?>

                    <p class="flavour-text"></p>
                </div>

                <div class="frame-bottom-into inner-margin">
                    <div class="fbi-left">
                        <p><?php echo $card->getId()." ".$card->getRarity()?></p>
                        <p>BS; EN <!-- paintbrush --> Probably Me lol</p>
                    </div>
                    <div class="fbi-center"></div>
                    <div class="fbi-right">
                        Me
                    </div>
                </div>

            </div>
        </div>
    </div>

    </html>

    <?php
}

$cards = loadCardsFromFile();

/*
//Adding text to image
$card = $cards["A23"];
header("Content-type: image/jpeg");
$imgPath = 'GoldAction.jpg';
$image = imagecreatefromjpeg($imgPath);
$color = imagecolorallocate($image, 0, 0, 0);
$string = $card->getText()[0];
$fontSize = 26;
//start x = 36, end x = 230
//start y = 260, end y = 340
$x = 36;
$y = 340;
imagestring($image, $fontSize, $x, $y, $string, $color);
imagejpeg($image, './TestPic.jpg');*/

/*

$card = $cards["A23"];

$actionTemplate = new ActionTemplate($card);

$actionTemplate->printFormattedText();

*/

//$actionTemplate->createTextBox();
/*
foreach($cards as $card){
    printCard($card);
}*/

