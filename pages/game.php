<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

//$deck = $_SESSION['deck'];

$deck = createTestDeck();

?>
    
<html>
  <!-- 
    https://hackernoon.com/how-to-build-a-multiplayer-browser-game-4a793818c29b by @omgimanerd consulted

  -->
  <head>
    <title>A Multiplayer Game</title>
    <style>
      canvas {
        width: 800px;
        height: 600px;
        border: 5px solid black;
      }
    </style>
    <script src="/socket.io/socket.io.js"></script>
  </head>
  <body>
    <canvas id="canvas"></canvas>
  </body>
  <script>
        let deck = <?php echo json_encode($deck)?>;
        let deckMaxLength = deck.length;
    </script>
  <script src="./static/game.js"></script>
</html>

<?php

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

