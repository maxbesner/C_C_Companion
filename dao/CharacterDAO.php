<?php
require_once('AbstractDAO.php');
include_once('C:/xampp/htdocs/CharacterBuilder/user/Character.php');
include_once('QuestionsDAO.php');

class CharacterDAO extends abstractDAO
{

    private $questionsDAO;

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }

        $this->questionsDAO = new QuestionsDAO();
    }


    public function addCharacter($userid, $character)
    {
        $insertQuery = 'INSERT INTO character_builder_character (character_name, age, gender, description, userid) VALUES (?,?,?,?,?)';
        $stmt = $this->mysqli->prepare($insertQuery);

        $name = $character->getName();
        $age = $character->getAge();
        $gender = $character->getGender();
        $description = $character->getDescription();

        $stmt->bind_param('sissi', $name, $age, $gender, $description, $userid);
        $stmt->execute();

        if($stmt->error)
        {
            return false;
        }

        $character->setId($this->mysqli->insert_id);
        return true;

    }


    public function getCharacters($id)
    {
        $characterQuery = 'SELECT * FROM character_builder_character WHERE userid = ?';
        $stmt = $this->mysqli->prepare($characterQuery);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $characters = Array();

        if($result->num_rows >= 1)
        {
            while($row = $result->fetch_assoc())
            {
                $id = $row['character_id'];
                $character = new Character($row['character_name']);
                $character->setId($id);
                $character->updateOptionalFields($row['age'], $row['gender'], $row['description']);
                $this->questionsDAO->getQuestions($character);
                $character->processQuiz();
                $characters[$id] = $character;
            }
            $result->free();
            return $characters;
        }
        $result->free();
        return false;
    }

    public function archiveCharacters($userid)
    {
        $insertQuery = 'INSERT INTO character_archive SELECT * FROM character_builder_character WHERE userid = ?';
        $stmt = $this->mysqli->prepare($insertQuery);
        $stmt->bind_param('i', $userid);
        $stmt->execute();

        $this->questionsDAO->archiveQuestions($userid);
    }

    public function deleteCharacters($userid)
    {
        if (!$this->mysqli->connect_errno) {

            $this->questionsDAO->deleteQuestions($userid);

            $query = 'DELETE FROM character_builder_character WHERE userid = ?';
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

    public function updateCharacter($character)
    {
        $answers = $character->getAnswers();

        $characterId = $character->getId();
        $name = $character->getName();
        $age = $character->getAge();
        $gender = $character->getGender();
        $description = $character->getDescription();

        $this->questionsDAO->updateAnswers($answers, $character);

        if(!$this->mysqli->connect_errno)
        {
            $query = 'UPDATE character_builder_character SET character_name = ?, age = ?, gender = ?, description = ? WHERE character_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('sissi', $name, $age, $gender, $description, $characterId);
            $stmt->execute();
            if($stmt->error)
            {
                return false;
            }
            else{
                return $stmt->affected_rows;
            }
        }
        else
        {
            return false;
        }
    }







    public function editEntry($id, $customerName)
    {
        if(!$this->mysqli->connect_errno)
        {
            $query = 'UPDATE mailingList SET customerName = ? WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('si', $customerName, $id);
            $stmt->execute();
            if($stmt->error)
            {
                return false;
            }
            else{
                return $stmt->affected_rows;
            }
        }
        else
        {
            return false;
        }
    }


}