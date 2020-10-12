<?php

include_once('./quiz/Questions.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');


session_start();

$quiz = $_SESSION['quiz'];

$sliderQuestions = $quiz->getSliderQuestions();

foreach($sliderQuestions as $question)
{
    $questionName = "slider".$question->getId();

    $question->setValue($_POST[$questionName]);
}

$page_title = "Character Creation Questions Page 1";
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/header.php');
?>


    <form name="quizPage2" method="post" action="quizFinish.php" enctype="multipart/form-data">
        <?php

        $yesNoQuestions = $quiz->getYesOrNoQuestions();

        foreach($yesNoQuestions as $question)
        {
            $questionName = "yesNo".$question->getId();
            echo '<p>'.$question->getText().'</p>';
            echo '<br>';
            echo 'No<input type="radio" name="'.$questionName.'" value="false"/>';
            echo 'Yes<input type="radio" name="'.$questionName.'" value="true"/>';
            echo '<br>';
            echo '<br>';
        }
        ?>

        <td><input type="submit" name="submit" id="submit" value="Submit"></td>
        <td><input type="reset" name="reset" id="reset" value="Reset"</td>

    </form>

<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/footer.php');
