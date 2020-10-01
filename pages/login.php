<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');

    session_start();

    //redirect user to homepage if already logged in
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->isAuthenticated())
        {
            session_write_close();
            header('Location:index.php');
        }
    }

    //If there are no missing fields, create a new User, add them to the session, and redirect to homepage
    $missingFields = false;
    if(isset($_POST['submit']))
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            if($_POST['username'] == "" || $_POST['password'] == "")
            {
                $missingFields = true;
            }
            else{
                $user = new User();

                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $user->authenticate($username, $password);
                    if($user->isAuthenticated())
                    {
                        $_SESSION['user'] = $user;
                        header('Location:index.php');
                    }
            }
        }
    }

    $page_title="Login";
    include_once('header.php');

    //If there are missing fields, indicate that user must enter both
    if($missingFields)
    {
        echo '<h3 style="color:red;">Please enter both a username and a password</h3>';
    }

    //If user does not exist in records, login fails
    if(isset($user))
    {
        if(!$user->isAuthenticated())
        {
            echo '<h3 style="color:red;">Login failed. Please try again.</h3>';
        }
    }

    ?>

<form name="login" id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" id="username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Login"></td>
            <td><input type="reset" name="reset" id="reset" value="Reset"</td>
        </tr>
        <tr>
            <td>Dont have an Account?</td>
            <td><a href="register.php">Register</a></td>
        </tr>
    </table>
</form>

<?php
include_once('footer.php');

