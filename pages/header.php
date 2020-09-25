<?php 
	if(!isset($page_title)) { $page_title = 'Generic Header'; }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Character Builder - <?php echo $page_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='http://fonts.googleapis.com/css?family=Fugaz+One|Muli|Open+Sans:400,700,800' rel='stylesheet' type='text/css' />
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>
	
    <body>
        <div id="wrapper">
            <header class="clearfix">
                <img src="" alt="Character Builder Photo" title="Character Builder Photo"/>
                <div id="title">
                    <h1>Character Builder</h1>
                </div>
            </header>
            <nav>
                <div id="menuItems">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="characterCreation.php">Create a Character</a></li>
                        <li><a href="myCharacters.php">My Characters</a></li>
                        <li><a href="cards/cards.php?">Cards</a></li>
                        <li><a href="gameHelper.php?">Game Helper</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="confirmDelete.php">Delete Account</a></li>

                    </ul>
                </div>
            </nav>