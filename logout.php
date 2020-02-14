<?php
session_start();
session_destroy();
$_SESSION=[];
session_unset();

header("Location:index.php");
exit;
?>
