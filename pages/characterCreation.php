<?php
include_once('./quiz/Questions.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/SessionManager.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/User.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title = "Character Creation";
include_once('header.php');

    echo '<a href="quiz/quizBasicInfo.php?newQuiz=true">Start New Quiz</a>';
    echo '<a href="quiz/quizBasicInfo.php?newQuiz=false">Resume Quiz</a>';
    echo '<a href="cards/cards.php?">Cards</a>';

include_once('footer.php');
