<?php

include_once('./Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/user/Character.php');

session_start();

$questions = $_SESSION['questions'];

$page_title = "Character Creation Questions Sliders";
include_once('header.php');

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
            $sliderNumber = "slider".$i;

            $value = 6;
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
include_once('footer.php');


