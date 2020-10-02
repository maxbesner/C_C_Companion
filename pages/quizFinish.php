<?php

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/dao/CharacterDAO.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/dao/QuestionsDAO.php');

//Save selected traits from previous page
function setTraits($character, $questions)
{
    $traits = $questions->getTraits();
    $possessedTraits = Array();
    foreach($traits as $trait)
    {
        $traitName = $trait->getText();
        if(isset($_GET[$traitName]))
        {
            $traitText = $trait->getText();
            $possessedTraits[$traitText] = $trait;
        }
    }
    $character->setTraits($possessedTraits);
    $questions->setSubmitted("traits");
}

//Update character data if already exists in database
function updateCharacter($characterDAO, $character)
{
    if($characterDAO->updateCharacter($character))
    {
        return true;
    }
    return false;
}

//Write character to database if did not already exist
function writeCharacter($characterDAO, $questionsDAO, $user, $character)
{
    $userId = $user->getId();

    if($characterDAO->addCharacter($userId, $character))
    {
        if($questionsDAO->addAnswers($character))
        {
            return true;
        }
    }
    return false;
}

$page_title = "Character Creation End";
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/header.php');

session_start();

$characterDAO = new CharacterDAO();
$questionsDAO = new QuestionsDAO();

$questions = $_SESSION['questions'];

$character = $_SESSION['character'];

$user = $_SESSION['user'];

$character->setAnswers($questions);

setTraits($character, $questions);

$success = false;

if(isset($_SESSION['edit']))
{
    if(updateCharacter($characterDAO, $character))
    {
        $success = true;
    }

    $_SESSION['edit'] = null;

}
else
{
    if(writeCharacter($characterDAO, $questionsDAO, $user, $character))
    {
        $success = true;
    }
}

if($success)
{
    $character->processQuiz();

    $user->addCharacter($character);
}

echo '<h3>Questions  Finished!</h3>';
echo '<a href=\'characterInfo.php?id='.$character->getId().'\'>'.'Get Results'.'</a></td>';

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/footer.php');
