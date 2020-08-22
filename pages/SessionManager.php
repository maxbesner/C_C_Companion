<?php

class SessionManager
{
    public function requireLogin()
    {
        session_start();
        session_regenerate_id(false);

        if(isset($_SESSION['user']))
        {
            if(!$_SESSION['user']->isAuthenticated())
            {
                header('Location:login.php');
            }
        }
        else
        {
            header('Location:login.php');
        }
    }
}

