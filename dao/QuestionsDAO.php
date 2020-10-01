<?php

require_once('AbstractDAO.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');


class QuestionsDAO extends AbstractDAO
{
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    //Set  types of questions in character
    public function getQuestions($character)
    {
        $characterId = $character->getId();

        $character->setSliders($this->getSliders($characterId));
        $character->setYesNos($this->getYesNos($characterId));
        $character->setTraits($this->getTraits($characterId));
    }

    private function getSliders($characterId)
    {
        $sliderQuery = 'SELECT * FROM slider_answer WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($sliderQuery);
        $stmt->bind_param('i', $characterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $sliders = Array();

        if($result->num_rows >= 1)
        {
            while($row = $result->fetch_assoc())
            {
                $id = $row['slider_answer_id'];
                $text = $row['text'];
                $element = $row['element'];
                $answer = $row['answer'];
                $slider = new Question($text, $element, "Slider");
                $slider->setId($id);
                $slider->setAnswer($answer);
                $sliders[$id] = $slider;
            }
            $result->free();
            return $sliders;
        }
        $result->free();
        return false;
    }

    private function getYesNos($characterId)
    {
        $yesNoQuery = 'SELECT * FROM yes_no_answer WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($yesNoQuery);
        $stmt->bind_param('i', $characterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $yesNos = Array();

        if($result->num_rows >= 1)
        {
            while($row = $result->fetch_assoc())
            {
                $id = $row['yes_no_answer_id'];
                $text = $row['text'];
                $element = $row['element'];
                $answer = $row['answer'];
                $yesNo = new Question($text, $element, "YesNo");
                $yesNo->setId($id);
                $yesNo->setAnswer($answer);
                $yesNos[$id] = $yesNo;
            }
            $result->free();
            return $yesNos;
        }
        $result->free();
        return false;
    }

    private function getTraits($characterId)
    {
        $traitQuery = 'SELECT * FROM character_trait WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($traitQuery);
        $stmt->bind_param('i', $characterId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $traits = Array();

        if($result->num_rows >= 1)
        {
            while($row = $result->fetch_assoc())
            {
                $id = $row['id'];
                $text = $row['trait'];
                $element = $row['element'];
                $trait = new CharacterTrait($text, $element, "Trait");
                $trait->setId($id);
                $traits[$text] = $trait;
                echo $trait->getText();
            }
            $result->free();
            return $traits;
        }
        $result->free();
        return false;
    }

    private function addSliderAnswer($answer, $characterId)
    {
        $insertQuery = 'INSERT INTO slider_answer (text, element, answer, characterid) VALUES (?,?,?,?)';
        $stmt = $this->mysqli->prepare($insertQuery);

        $text = $answer->getText();
        $element = $answer->getElement();
        $value = $answer->getAnswer();

        $stmt->bind_param('ssii', $text, $element, $value, $characterId);
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        $answer->setId($this->mysqli->insert_id);

        return true;
    }

    private function addYesNoAnswer($answer, $characterId)
    {
        $insertQuery = 'INSERT INTO yes_no_answer (text, element, answered_yes, characterid) VALUES (?,?,?,?)';
        $stmt = $this->mysqli->prepare($insertQuery);

        $stmt->bind_param('ssbi', $answer->getText(), $answer->getElement(), $answer->getAnswer(), $characterId);
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        $answer->setId($this->mysqli->insert_id);

        return true;
    }

    public function addTraits($traits, $characterId)
    {
        foreach($traits as $trait)
        {
            $this->addTrait($trait, $characterId);
        }
    }

    public function addTrait($trait, $characterId)
    {
        $insertQuery = 'INSERT INTO character_trait (trait, element, characterid) VALUES(?,?,?)';
        $stmt = $this->mysqli->prepare($insertQuery);

        $traitName = $trait->getText();
        $element = $trait->getElement();

        $stmt->bind_param('ssi', $traitName, $element, $characterId);
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        $trait->setId($this->mysqli->insert_id);

        return true;
    }

    public function archiveQuestions($userid)
    {
        $this->archiveSliders($userid);
        $this->archiveYesNos($userid);
        $this->archiveTraits($userid);
    }

    private function archiveSliders($userid)
    {
        $insertQuery = 'INSERT INTO slider_archive SELECT * FROM slider_answer WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
        $stmt = $this->mysqli->prepare($insertQuery);
        $stmt->bind_param('i', $userid);
        $stmt->execute();
    }

    private function archiveYesNos($userid)
    {
        $insertQuery = 'INSERT INTO yes_no_archive SELECT * FROM yes_no_answer WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
        $stmt = $this->mysqli->prepare($insertQuery);
        $stmt->bind_param('i', $userid);
        $stmt->execute();
    }

    private function archiveTraits($userid)
    {
        $insertQuery = 'INSERT INTO trait_archive SELECT * FROM character_trait WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
        $stmt = $this->mysqli->prepare($insertQuery);
        $stmt->bind_param('i', $userid);
        $stmt->execute();
    }

    public function deleteQuestions($userid)
    {
        $this->deleteUserSliderAnswers($userid);
        $this->deleteUserYesNoAnswers($userid);
        $this->deleteUserTraits($userid);
    }

    private function deleteUserSliderAnswers($userid)
    {

        if (!$this->mysqli->connect_errno) {

            $query = 'DELETE FROM slider_answer WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $userid);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    private function deleteUserYesNoAnswers($userid)
    {

        if (!$this->mysqli->connect_errno) {

            $query = 'DELETE FROM yes_no_answer WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $userid);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    private function deleteUserTraits($userid)
    {

        if (!$this->mysqli->connect_errno) {

            $query = 'DELETE FROM character_trait WHERE characterid = ANY (SELECT character_id FROM character_builder_character WHERE userid = ?)';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $userid);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    private function deleteSliderAnswers($character)
    {
        $deleteQuery = 'DELETE FROM slider_answer WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($deleteQuery);

        $stmt->bind_param('i', $character->getId());
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        return true;
    }

    private function deleteYesNoAnswers($character)
    {
        $deleteQuery = 'DELETE FROM yes_no_answer WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($deleteQuery);

        $stmt->bind_param('i', $character->getId());
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        return true;
    }

    private function deleteTraits($character)
    {
        $deleteQuery = 'DELETE FROM character_trait WHERE characterid = ?';
        $stmt = $this->mysqli->prepare($deleteQuery);

        $characterId = $character->getId();

        $stmt->bind_param('i', $characterId);
        $stmt->execute();

        if($stmt->error)
        {
            return $stmt->error;
        }

        return true;
    }

    public function addAnswers($character)
    {
        $answers = $character->getAnswers();

        $characterId = $character->getId();

        foreach($answers->getSliderQuestions() as $sliderAnswer)
        {
            $this->addSliderAnswer($sliderAnswer, $characterId) ;
        }

        foreach($answers->getYesOrNoQuestions() as $yesNoAnswer)
        {
            $this->addSliderAnswer($yesNoAnswer, $characterId) ;
        }

        #todo add fail cases
        return true;
    }

    public function updateAnswers($answers, $character)
    {
        $this->deleteTraits($character);

        $sliders = $answers->getSliderQuestions();
        $yesNos = $answers->getYesOrNoQuestions();
        $traits = $character->getTraits();

        $characterId = $character->getId();

        $this->updateSliders($sliders);
        $this->updateYesNos($yesNos);
        $this->addTraits($traits, $characterId);
    }

    private function updateSliders($sliders)
    {
        foreach($sliders as $slider)
        {
            $sliderId = $slider->getId();
            $text = $slider->getText();
            $element = $slider->getElement();
            $answer = $slider->getAnswer();

            if(!$this->mysqli->connect_errno)
            {
                $query = 'UPDATE slider_answer SET text = ?, element = ?, answer = ? WHERE slider_answer_id = ?';
                $stmt = $this->mysqli->prepare($query);
                $stmt->bind_param('ssii', $text, $element, $answer, $sliderId);
                $stmt->execute();
                if($stmt->error)
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }

        return true;
    }

    private function updateYesNos($yesNos)
    {
        if($yesNos!= null)
        {
            foreach($yesNos as $yesNo)
            {
                $yesNoId = $yesNo->getId();
                $text = $yesNo->getText();
                $element = $yesNo->getElement();
                $answer = $yesNo->getAnswer();

                if(!$this->mysqli->connect_errno)
                {
                    $query = 'UPDATE yes_no_answer SET text = ?, element = ?, answer = ? WHERE yes_no_annswer_id = ?';
                    $stmt = $this->mysqli->prepare($query);
                    $stmt->bind_param('ssbi', $text, $element, $answer, $yesNoId);
                    $stmt->execute();
                    if($stmt->error)
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }

            return true;
        }

        return false;

    }


    public function resetQuiz($character)
    {
        if($result = $this->deleteSliderAnswers($character))
        {
            if($result = $this->deleteYesNoAnswers($character))
            {
                if($result = $this->deleteTraits($character))
                {
                    return true;
                }
                return $result;
            }
            return $result;
        }
        return $result;

    }



}