<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/dao/UserDAO.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/dao/CharacterDAO.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/Element.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/pages/ElementList.php');

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

    /**
     * Checks to see if record of User exists in database. If
     * a record does exist, updates the User's fields to be equal to
     * the fields in the database
     * @param $username
     * @param $password
     */
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


    /**
     * @param $id
     * The User's database id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     * The User's database id
     */
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

    /**
     * Retrieves the list of Characters belonging to the User from the database and sets their Characters array to it
     */
    public function setCharacters()
    {
        $this->characters = $this->characterDAO->getCharacters($this->getId());
    }


    /**
     * @param $character
     * A Character being added to the User's list of Characters
     */
    public function addCharacter($character)
    {
        $this->characters[$character->getId()] = $character;
    }

    /**
     * @param $characterId
     * The character id of the character being searched for
     *
     * @return false|mixed
     * The character being search for or false if it does not exist
     */
    public function getCharacter($characterId)
    {
        if(array_key_exists($characterId, $this->getCharacters()))
        {
            return $this->characters[$characterId];
        }
        return false;
    }

    /**
     * @return array
     * All Characters belong to User
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @return bool
     * Whether or not the User exists in the database
     */
    public function isAuthenticated()
    {
        return $this->authenticated;
    }
}