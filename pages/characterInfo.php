<?php

include_once('SessionManager.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/User.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/C&C_Companion/user/Character.php');

$sessionManager = new SessionManager();

$sessionManager->requireLogin();

$page_title = "Character Info";
include_once('header.php');

$character = $_SESSION['user']->getCharacter($_GET['id']);

$_SESSION['character'] = $character;

$elements = $_SESSION['elements']->getElements();

if(isset($character))
{
    echo '<h3>'.$character->getName().'</h3>';
    echo '<br>';
    ?>
    <input type="button" name="no" id=no" value="Edit" onclick="window.location.href='edit.php'">
    <?php
    echo '<table>';
    echo    '<tr>';
    echo        '<td>Age:</td>';
    echo        '<td>'.$character->getAge().'</td>';
    echo    '</tr>';
    echo    '<tr>';
    echo        '<td>Gender:</td>';
    echo        '<td>'.$character->getGender().'</td>';
    echo    '</tr>';
    echo    '<tr>';
    echo        '<td>Description:</td>';
    echo        '<td>'.$character->getDescription().'</td>';
    echo    '</tr>';
    echo '</table>';

    echo '<h5>Traits</h5>';
    echo '<br>';

    $traits = $character->getTraits();

    if($traits != null)
    {
        foreach($traits as $trait)
        {
            echo $trait->getText();
            echo '<br>';
        }
    }

    echo '<br>';

    echo '<h5>Elemental Breakdown</h5>';
    echo '<br>';

    foreach($character->getElements() as $element)
    {
        $percentage = $character->getPercentage($element);
        $description = $elements[$element]->getDescription();
        $colour = $elements[$element]->getColour();
        ?>
        <p style="color:<?php echo $colour?>;"><?php echo $element?>: <?php echo number_format($percentage, 1)?>%</p>
        <button type= "button" style="text-decoration: underline" onclick="alert('<?php echo $description ?>')">More info</button>
        <br>
        <br>

        <?php
    }
}
else
{
    echo '<h3> Character Not Found </h3>';
}

include_once('footer.php');

?>
