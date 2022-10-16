<?php

require_once('../includes/config.php');

echo '<h2>LOGIN</h2>';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $uname  = filter_input(INPUT_POST, 'uname');
    $umail  = filter_input(INPUT_POST, 'umain', FILTER_SANITIZE_EMAIL);
    $upass  = filter_input(INPUT_POST, 'upass');
    
    $stmt = $db->prepare('SELECT `uid`, `uname`, `upass` FROM `userliste` WHERE `uname` = :uname');
    $stmt->execute(array(':uname' => $uname));
    $row = $stmt->fetch();
    
    if ($row !== FALSE && password_verify($upass, $row['upass'])) {
        $_SESSION['uname'] = $uname;
        header('Location: index.php');
        exit;
    }
    else {
        $fehler = '<p>Username oder Passwort ist falsch!</p>';
    }
    
}

if (isset($fehler)) {
    echo $fehler;
}

?>
 
<form method="POST">
<p>Username:<br><input type="text" name="uname" placeholder="" required></p>
<p>Passwort:<br><input type="password" name="upass" placeholder="" required></p>
<p><input type="submit" value="Abschicken"></p>
</form>
