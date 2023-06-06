<?php
session_start();
array_splice($_SESSION["purchases_details"],intval($_POST["index"]),1);

?>
