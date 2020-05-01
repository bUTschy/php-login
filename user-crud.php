<?php

require_once('../includes/config.php');

echo '<h2>USER-CRUD</h2>';

$formular = TRUE; 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $fehler = FALSE;
    $uname  = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
    $umail  = filter_input(INPUT_POST, 'umail', FILTER_SANITIZE_EMAIL);
    $upass  = filter_input(INPUT_POST, 'upass');
    $upass2 = filter_input(INPUT_POST, 'upass2');
    
    if (empty($uname)) {
        echo '<p>Kein Name angegeben!</p>';
        $fehler = TRUE;
    }
    
    if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        echo '<p>Keine gültige eMail angegeben!</p>';
        $fehler = TRUE;
    }
    
    if (empty($upass)) {
        echo '<p>Kein Passwort angegeben!</p>';
        $fehler = TRUE;
    }
    
    if ($upass != $upass2) {
        echo '<p>Passwörter sind nicht identisch!</p>';
        $fehler = TRUE;
    }
    
    if (!$fehler) {

        $stmt = $db->prepare('SELECT `uid`, `uname`, `upass`, `umail` FROM `userliste` WHERE `umail` = :umail');
        $stmt->execute(array(':umail' => $umail));
        $row = $stmt->fetch();
        
        if ($row !== FALSE) {
            echo '<p>eMail bereits vergeben!</p>';
            $fehler = TRUE;
        }
    }
    
    if (!$fehler) {
        
        $pass_hash = password_hash($upass, PASSWORD_ARGON2ID);
        $stmt = $db->prepare('INSERT INTO `userliste` (uname, upass, umail) VALUES (:uname, :upass, :umail)');
        $row = $stmt->execute(array('uname' => $uname, 'upass' => $pass_hash, 'umail' => $umail));
        
        if ($row) {
            echo '<p>Neuer User hinzugefügt. <a href="login.php">login.php</a></p>';
            $formular = FALSE;
        }
        
        else {
            echo '<p>INSERT Fehler!</p>';
        }
    }
}

// formular 
if ($formular) {
    echo '<form method="POST">';
    echo '<p>uname:<br><input type="text" name="uname"></p>';
    echo '<p>umail:<br><input type="email" name="umail"></p>';
    echo '<p>upass:<br><input type="password" name="upass"></p>';
    echo '<p>upass2:<br><input type="password" name="upass2"></p>';
    echo '<p><input type="submit" value="Abschicken"></p>';
    echo '</form>';
}

?>
