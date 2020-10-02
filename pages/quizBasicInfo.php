<?php

include_once('./quiz/Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');


session_start();

$page_title = "Character Creation Basic Info";
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/header.php');

if($_GET['newQuiz'] == "true")
{
    //Load the questions on the quiz and add them to the session
    $questions = new Questions();
    $questions->loadQuestionsFromFile(false);
    $_SESSION['questions'] = $questions;

    //Create a new Character object for the character taking the quiz and add it to the session
    $character = new Character("");
    $_SESSION['character'] = $character;

    //Add to session that this character does not exist in the database
    $_SESSION['edit'] = null;
}
elseif(!isset($_SESSION['questions']))
{
    //Redirect if user tries to update answers but no quiz in session
    header('Location:../characterCreation.php');
}
else
{
    //Get set of questions from session
    $questions = $_SESSION['questions'];

    //Load only the list of traits if necessary
    if($questions->getTraits() == null)
    {
        $questions->loadQuestionsFromFile(true);
    }

}

//Update questions in session
$questions = $_SESSION['questions'];
//Randomize questions
$questions->shuffleQuestions();

$character = $_SESSION['character'];


?>

    <form name="quizBasicInfo" method="get" action="quizSliders.php">
        <table>
            <tr>
                <td>Character Name*</td>
                <?php echo'<td><label for="characterName"></label><input type="text" name="characterName" id="characterName" value='.$character->getName().'></td>'?>
            </tr>
            <tr>
                <td>Age*</td>
                <?php echo'<td><label for="characterAge"></label><input type="text" name="characterAge" id="characterAge" value='.$character->getAge().'></td>'?>
            </tr>
            <tr>
                <td>Gender</td>
                <?php echo'<td><label for="characterGender"></label><input type="text" name="characterGender" id="characterGender" value='.$character->getGender().'></td>'?>
            </tr>
            <tr>
                <td>Description</td>
                <?php echo'<td><label for="characterDescription"></label><input type="text" name="characterDescription" id="characterDescription" value='.$character->getDescription().'></td>'?>
            </tr>

        </table>



        <input type="submit" name="submit" id="submit" value="Next Page">
        <input type="reset" name="reset" id="reset" value="Reset">

    </form>

<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/footer.php');
