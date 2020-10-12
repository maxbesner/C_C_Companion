<?php

include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/user/Character.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/user/DeckManager.php');


$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$characters = $_SESSION['user']->getCharacters();


include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/pages/header.php');



?>

    <script>
        let decksByCharacterId = new Map();
        let decks;

        <?php
            foreach($characters as $character){
                $character = createAndAddTestDecks($character);
                ?> decks = [];<?php

                foreach($character->getDecks() as $deck){
                    ?>decks.push({id: "<?php echo $deck->getId()?>", name: "<?php echo $deck->getName()?>"});<?php
                }

                ?>decksByCharacterId.set("<?php echo $character->getId()?>", decks);<?php
            }
        ?>



    </script>
    <script src="joinGame.js">
    </script>

    <form name="quizBasicInfo" method="get" action="quizSliders.php">

        <?php writeCharacterDropdownMenu(); ?>

        <div id="deckDropdown" class="dropdown" hidden>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="deckDropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Choose a Deck
            </button>
            <div id="deckDropdownMenu" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            </div>

        </div>

    </form>
<?php

function writeCharacterDropdownMenu()
{

    ?>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Choose a Character
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
            $characters = $_SESSION['user']->getCharacters();

            foreach ($characters as $character) {
                ?>
                <a id="character<?php echo $character->getId() ?>"
                   class="dropdown-item"
                   onclick="createDeckDropdown('<?php echo $character->getId()?>')"><?php echo $character->getId() . ": " . $character->getName() ?></a>
                <?php
            }

            ?>
        </div>

    </div>
    <?php
}

include_once($_SERVER["DOCUMENT_ROOT"] . '/C&C_Companion/pages/footer.php');

function createAndAddTestDecks($character)
{
    $testDeck1 = new DeckManager("D1");
    $testDeck1->setName("Super Deck");

    $testDeck2 = new DeckManager("D2");
    $testDeck2->setName(null);

    $character->addToDecks($testDeck1);
    $character->addToDecks($testDeck2);

    return $character;
}

function p(){
    alert(decksByCharacterId("<?php echo $characters[0]->getId()?>")[0].name);

}

