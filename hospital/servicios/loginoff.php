<?php
setcookie("usuarios", "", time() - 3600, "/");
header("Location: hospital.php");
?>