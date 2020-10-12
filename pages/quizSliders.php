<?php

include_once('./quiz/Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');

session_start();

$questions = $_SESSION['questions'];

$page_title = "Character Creation Questions Sliders";
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/header.php');

$name = "";

if(isset($_GET['characterName']))
{
    $name = $_GET['characterName'];
}

if(isset($_GET['characterAge']))
{
    $age = $_GET['characterAge'];
}

if(isset($_GET['characterGender']))
{
    $gender = $_GET['characterGender'];
}

if(isset($_GET['characterDescription']))
{
    $description = $_GET['characterDescription'];
}

if($name != "")
{
    $character = $_SESSION['character'];

    $character->setName($name);

    $character->updateOptionalFields($age, $gender, $description);

    $_SESSION['character'] = $character;

    $questions->setSubmitted("basicInfo");
}
else
{
    //Redirect user if fields are missing from the previous page
    header('error.php?error=missingFields');
}

?>

<form name="quizSliders" method="get" action="quizTraits.php">
        <?php

        $sliderQuestions = $questions->getSliderQuestions();

        $questions->setSliderQuestions($sliderQuestions);

        $i = 0;

        foreach($sliderQuestions as $question)
        {
            $questionText = $question->getText();

            //Set the html name of the question
            $sliderNumber = "slider".$i;

            //Default slider value is 6
            $value = 6;

            //If question was already answered set value to previously answered value
            if($questions->isSubmitted("sliders"))
            {
                $value = $question->getAnswer();
            }

            echo '<p>'.$questionText.'</p>';
            echo '<br>';
            echo '<input type="range" name="'.$sliderNumber.'" min="1" max="10" value="'.$value.'"/> ';
            echo '<br>';
            echo '<br>';

            $i++;
        }
        ?>

    <input type="button" name="prev" id=prev" value="Previous" onclick="window.location.href='quizBasicInfo.php'">
    <input type="submit" name="submit" id="submit" value="Next Page">
    <input type="reset" name="reset" id="reset" value="Reset">

</form>

<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/footer.php');


