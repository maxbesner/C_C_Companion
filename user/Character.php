<?php

include_once('C:/xampp/htdocs/CharacterBuilder/pages/quiz/Questions.php');
include_once('C:/xampp/htdocs/CharacterBuilder/dao/CharacterDAO.php');
include_once('C:/xampp/htdocs/CharacterBuilder/dao/QuestionsDAO.php');


class Character
{
    private $id;
    private $name;
    private $gender;
    private $age;
    private $description;
    private $traits = Array();
    private $answers;

    private $characterDao;
    private $questionsDao;

    private $scores;
    private $total;

    private $elements = Array("Gold", "Copper", "Iron", "Calcium", "Lead", "Mercury");

    public function __construct($name)
    {
        $this->characterDao = new CharacterDAO();
        $this->questionsDao = new QuestionsDAO();

        $this->setName($name);
        $this->updateOptionalFields("","","");
        $this->resetScores();

        $this->answers = new Questions();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }


    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }


    public function setDescription($description)
    {
        $this->description= $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setTraits($traits)
    {
        $this->traits = $traits;
    }

    public function getTraits()
    {
        return $this->traits;
    }

    public function addTrait($trait)
    {
        $traitText = $trait->getText();
        $this->traits[$traitText] = $trait;
    }

    public function removeTrait($trait)
    {
        $traitText = $trait->getText();

        if($this->hasTrait($traitText))
        {
            unset($trait, $this->traits);
        }
    }

    public function hasTrait($traitText)
    {
        return array_key_exists($traitText, $this->traits);
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function setSliders($sliders)
    {
        $this->getAnswers()->setSliderQuestions($sliders);
    }

    public function setYesNos($yesNos)
    {
        $this->getAnswers()->setYesOrNoQuestions($yesNos);
    }

    public function getElements()
    {
        return $this->elements;
    }
    public function resetScores()
    {
        $this->scores = array();

        foreach($this->elements as $element)
        {
            $this->scores[$element] = 0;
            $this->total = 0;
        }
    }

    private function updateTotal()
    {
        foreach($this->scores as $score)
        {
            $this->total += $score;
        }
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getPercentage($element)
    {
        if($this->total != 0)
        {
            return 100*$this->scores[$element]/$this->total;
        }

        return 0;

    }

    public function processQuiz()
    {
        $this->resetScores();

        foreach($this->answers->getSliderQuestions() as $question)
        {
            foreach($this->elements as $element)
            {
                if($question->getElement() == $element)
                {
                    $this->scores[$element] += $question->getAnswer();
                }
            }
        }
        foreach($this->answers->getYesOrNoQuestions() as $question)
        {
            foreach($this->elements as $element)
            {
                if($question->getElement() == $element && $question->getAnswer() == "Yes")
                {
                    $this->scores[$element] += 5.5;
                }
            }
        }
        foreach($this->getTraits() as $trait)
        {
            foreach($this->elements as $element)
            {
                if($trait->getElement() == $element)
                {
                    $this->scores[$element] += 5.5;
                }
            }
        }

        $this->updateTotal();
    }

    public function updateOptionalFields($age, $gender, $description)
    {
        if(isset($age))
        {
            $this->setAge($age);
        }
        if(isset($gender))
        {
            $this->setGender($gender);
        }
        if(isset($description))
        {
            $this->setDescription($description);
        }
    }
}