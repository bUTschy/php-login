<?php

require_once('../includes/config.php');

if (!isset($_SESSION['uname'])) {
    header('Location: login.php');
    exit;
}

echo '<h2>ADMINISTRATION</h2>';

echo '<p>Hi <mark>'.$_SESSION['uname'].'</mark>, du bist eingeloggt.</p>';

echo '<p><a href="logout.php">Abmelden</a></p>';

?>
