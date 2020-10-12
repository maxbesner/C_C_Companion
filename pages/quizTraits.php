<?php

include_once('./quiz/Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');

session_start();

$questions = $_SESSION['questions'];

$sliderQuestions = $questions->getSliderQuestions();

//Update list of questions with answers from previous page
for($i = 0; $i < count($sliderQuestions); $i++ )
{
    $question = $sliderQuestions[$i];
    $sliderNumber = "slider".$i;
    $question->setAnswer($_GET[$sliderNumber]);
}
$questions->setSubmitted("sliders");

$page_title = "Character Creation Questions Page 1";
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/header.php');
?>


    <form name="quizTraits" method="get" action="quizFinish.php">
        <?php

        $traits = $questions->getTraits();

        $character = $_SESSION['character'];

        foreach($traits as $trait)
        {
            $traitName = $trait->getText();

            if($character->hasTrait($traitName))
            {
                echo $traitName.'<input type="checkbox" name="'.$traitName.'" value="'.$traitName.'" checked/>';
            }
            else
            {
                echo $traitName.'<input type="checkbox" name="'.$traitName.'" value="'.$traitName.'"/>';
            }

            echo '<br>';
        }
        ?>

        <input type="button" name="prev" id=prev" value="Previous" onclick="window.location.href='quizSliders.php'">
        <td><input type="submit" name="submit" id="submit" value="Submit"></td>
        <td><input type="reset" name="reset" id="reset" value="Reset"</td>

    </form>

<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/footer.php');
