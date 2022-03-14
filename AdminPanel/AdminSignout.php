<?php
unset($_SESSION["Admin"]);
session_destroy();

header("Location:index.php");
exit();
?>