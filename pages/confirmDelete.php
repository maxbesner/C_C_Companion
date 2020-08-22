<?php


include_once('SessionManager.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/User.php');
require_once('C:/xampp/htdocs/CharacterBuilder/dao/UserDAO.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$user = $_SESSION['user'];

$name = $user->getUsername();

echo "<h3>Are you sure you want to delete the account with the username $name?</h3>";

?>

<input type="button" name="no" id=no" value="No" onclick="window.location.href='index.php'">
<input type="button" name="yes" id=yes" value="Yes" onclick="window.location.href='delete.php'">