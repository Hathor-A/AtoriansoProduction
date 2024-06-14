<?php
require 'config.php';

session_start();
session_unset();
session_destroy();
header("Location: AtoProd.html");
exit;
?>
<?php
session_start();
if (isset($_SESSION['username'])) {
    echo '<li><a href="/basSQL/logout.php">Déconnexion</a></li>';
}
?>

