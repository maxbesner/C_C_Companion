<?php
include_once('C:/xampp/htdocs/CharacterBuilder/dao/UserDAO.php');
include_once('C:/xampp/htdocs/CharacterBuilder/dao/CharacterDAO.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/Element.php');
include_once('C:/xampp/htdocs/CharacterBuilder/pages/ElementList.php');

class User
{
    private $id;
    private $username;
    private $password;
    private $characters = Array();
    private $authenticated = false;
    private $isAdmin = false;
    private $userDAO;
    private $characterDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->characterDAO = new CharacterDAO();
    }

    public function authenticate($username, $password)
    {
        $id = $this->userDAO->authenticate($username, $password);
        if($id != null)
        {
            $this->setId($id);
            $this->username = $username;
            $this->password = $password;
            $this->setCharacters();
            $_SESSION['elements'] = new ElementList();
            $this->authenticated = true;
        }
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setCharacters()
    {
        $this->characters = $this->characterDAO->getCharacters($this->getId());
    }


    public function addCharacter($character)
    {
        $this->characters[$character->getId()] = $character;
    }

    public function getCharacter($characterId)
    {
        if(array_key_exists($characterId, $this->getCharacters()))
        {
            return $this->characters[$characterId];
        }
        return false;
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function isAuthenticated()
    {
        return $this->authenticated;
    }
}