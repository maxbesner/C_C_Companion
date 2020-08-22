<?php

include_once('Questions.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/Character.php');

session_start();

$page_title = "Character Creation Basic Info";
include_once('header.php');

if($_GET['newQuiz'] == "true")
{
    $questions = new Questions();
    $questions->loadQuestionsFromFile(false);
    $_SESSION['questions'] = $questions;

    $character = new Character("");
    $_SESSION['character'] = $character;

    $_SESSION['edit'] = null;
}
elseif(!isset($_SESSION['questions']))
{
    header('Location:../characterCreation.php');
}
else
{
    $questions = $_SESSION['questions'];

    if($questions->getTraits() == null)
    {
        $questions->loadQuestionsFromFile(true);
    }

}

$questions = $_SESSION['questions'];
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
include_once('footer.php');