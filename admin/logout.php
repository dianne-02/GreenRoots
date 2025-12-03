<?php
// FILE: logout.php
session_start();
session_unset();
session_destroy();

// Idirekta pabalik sa login page
header("Location: login.html");
exit();
?>