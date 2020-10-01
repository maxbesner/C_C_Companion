<?php
include_once('./quiz/Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title = "Character Creation";
include_once('header.php');

    echo '<a href="quizBasicInfo.php?newQuiz=true">Start New Quiz</a>';
    echo '<a href="quizBasicInfo.php?newQuiz=false">Resume Quiz</a>';



include_once('footer.php');
