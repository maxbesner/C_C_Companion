<?php
include_once('SessionManager.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/User.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title= "Home";
require_once('header.php');
require_once('footer.php');
