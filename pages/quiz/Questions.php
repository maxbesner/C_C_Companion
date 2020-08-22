<?php

include_once('Response.php');
include_once('Question.php');
include_once('CharacterTrait.php');


class Questions
{
    private $sliderQuestions = Array();
    private $yesOrNoQuestions = Array();
    private $traits = Array();
    private $submitted = Array("basicInfo" => false, "sliders" => false, "traits" => false);

    public function __construct()
    {

    }

    public function loadQuestionsFromFile($onlyTraits)
    {
        $f = "C:/xampp/htdocs/CharacterBuilder/dao/questions.txt";
        $file = fopen($f, "r") or die("Unable to open file");

        while(!feof($file))
        {
            $text = trim(fgets($file));
            $element = trim(fgets($file));
            $questionType = trim(fgets($file));
            fgets($file);

            if(!$onlyTraits)
            {
                if($questionType == "Slider")
                {
                    $this->addSliderQuestion(new Question($text, $element, $questionType));
                }

                if($questionType == "YesNo")
                {
                    $this->addYesOrNoQuestion(new Question($text, $element, $questionType));
                }
            }

            if($questionType == "Trait")
            {
                $this->addTrait(new CharacterTrait($text, $element, $questionType));
            }
        }

        fclose($file);
    }

    public function setSliderQuestions($questions)
    {
        $this->sliderQuestions = $questions;
    }

    public function getSliderQuestions()
    {
        return $this->sliderQuestions;
    }

    private function addSliderQuestion($question)
    {
        $this->sliderQuestions[] = $question;
    }

    public function setYesOrNoQuestions($questions)
    {
        $this->yesOrNoQuestions = $questions;
    }

    public function getYesOrNoQuestions()
    {
        return $this->yesOrNoQuestions;
    }

    private function addYesOrNoQuestion($question)
    {
        $this->yesOrNoQuestions[] = $question;
    }

    public function setTraits($traits)
    {
        $this->traits = $traits;
    }


    public function getTraits()
    {
        return $this->traits;
    }

    private function addTrait($question)
    {
        $this->traits[] = $question;
    }

    public function setSubmitted($page)
    {
        $this->submitted[$page] = true;
    }

    public function isSubmitted($page)
    {
        return $this->submitted[$page];
    }

    public function shuffleQuestions()
    {
        shuffle($this->sliderQuestions);
        shuffle($this->traits);
    }



}