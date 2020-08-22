<?php

include_once('SessionManager.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/User.php');
require_once('C:/xampp/htdocs/CharacterBuilder/dao/UserDAO.php');

session_start();

$user = $_SESSION['user'];

$userid = $user->getId();


$dao = new UserDAO();

$dao->deleteUser($userid);

session_unset();
session_destroy();
session_start();
session_regenerate_id();

header('Location:login.php');