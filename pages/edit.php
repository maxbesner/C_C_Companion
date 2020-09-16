<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/user/Character.php');

session_start();

$character = $_SESSION['character'];

$questions = $character->getAnswers();

$_SESSION['questions'] = $questions;

$_SESSION['edit'] = "true";

header('Location:./quiz/quizBasicInfo.php?newQuiz=false');

#todo prevent double submission of characters