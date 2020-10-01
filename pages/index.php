<?php
include_once('SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title= "Home";
require_once('header.php');
require_once('footer.php');
