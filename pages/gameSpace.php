<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Player.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title = "Character Creation";
include_once('header.php');

//$deck = $_SESSION['deck'];

$deck = createTestDeck();

$hand = array();

?>
    <script>
        let deck = <?php echo json_encode($deck)?>;
        let deckMaxLength = deck.length;
    </script>
    <script src="gameSpace.js">
    </script>
<button id="cardDraw" onclick="drawCard()">Draw</button>
<?php writeEmptyCardSpaces($deck); ?>
<img id="deck" src="" alt="emptyDeck">
<img id="discardPile" src="" alt="discardPile" hidden>

<?php

include_once('footer.php');

function writeEmptyCardSpaces($deck){
    for($i = 0; $i < count($deck); $i++){
        $imageId = "cardInHand".$i;

        ?>
        <img id="<?php echo $imageId?>" src="" alt ="<?php echo $imageId?>" onclick="confirmDiscard(<?php echo $i?>)" hidden>
        <?php

    }
}

function createTestDeck(){

    $deck = array();

    for($i = 1; $i <= 10; $i++){
        for($j = 0; $j < 3; $j++){
            $deck[] = './cards/cardImages/A'.$i.'.jpg';
        }
    }

    shuffle($deck);

    return $deck;
}

