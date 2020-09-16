
<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/CharacterBuilder/dao/UserDAO.php');
session_start();
if(isset($_SESSION['user']))
{
    if($_SESSION['user']->isAuthenticated())
    {
        session_write_close();
        header('Location:index.php');
    }
}
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
            $dao = new UserDAO();
            $dao->addUser($_POST['username'], $_POST['password']);

            header('Location:login.php');

        }
    }
}

$page_title="Register";
include_once('header.php');

if($missingFields)
{
    echo '<h3 style="color:red;">Please enter both a username and a password</h3>';
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
            <td><input type="submit" name="submit" id="submit" value="Register"></td>
            <td><input type="reset" name="reset" id="reset" value="Reset"</td>
        </tr>
    </table>
</form>

<?php
include_once('footer.php');
