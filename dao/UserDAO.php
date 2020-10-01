<?php

require_once('AbstractDAO.php');
include_once('CharacterDAO.php');

class UserDAO extends abstractDAO
{

    private $characterDAO;
    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }

        $this->characterDAO = new CharacterDAO();
    }

    //Adds user to database if username, password combination does not exist in database
    public function addUser($username, $password)
    {
        $loginQuery = 'SELECT * FROM character_builder_user WHERE username = ?';
        $stmt = $this->mysqli->prepare($loginQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();
        if($result->num_rows == 0)
        {
            $insertQuery = 'INSERT INTO character_builder_user (username, password_hash) VALUES (?,?)';
            $stmt = $this->mysqli->prepare($insertQuery);
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bind_param('ss', $username, $passwordHash);
            $stmt->execute();

            if($stmt->error)
            {
                return $stmt->error;
            }
            return true;
        }
        return $username."already exists";
    }

    //Archives user and associated data, then deletes user from active user table
    public function deleteUser($userid)
    {
        if (!$this->mysqli->connect_errno) {

            $this->archiveUser($userid);

            $this->characterDAO->deleteCharacters($userid);

            $query = 'DELETE FROM character_builder_user WHERE user_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $userid);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return $userid.' deleted successfully';
            }
        } else {
            return false;
        }
    }

    //Adds user and all associated data to the archive table. Used when deleting user from active user table
    private function archiveUser($userid)
    {

        $insertQuery = 'INSERT INTO user_archive SELECT * FROM character_builder_user WHERE user_id = ?';
        $stmt = $this->mysqli->prepare($insertQuery);
        $stmt->bind_param('i', $userid);
        $stmt->execute();

        $this->characterDAO->archiveCharacters($userid);
    }

    //Verifies the username, password combination exists in the database
    public function authenticate($username, $password)
    {
        $loginQuery = 'SELECT * FROM character_builder_user WHERE username = ?';
        $stmt = $this->mysqli->prepare($loginQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password_hash']))
        {
            return $row['user_id'];
        }

        return null;
    }

    //Verifies whether the user has admin privileges
    public function isAdmin($user)
    {
        $verificationQuery = 'SELECT * FROM character_builder_user WHERE user_id = ? && isAdmin = true';
        $stmt = $this->mysqli->prepare($verificationQuery);
        $stmt->bind_param('i', $user->getId());
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->free_result();

        if($result->num_rows == 1)
        {
            return true;
        }

        return false;
    }
}