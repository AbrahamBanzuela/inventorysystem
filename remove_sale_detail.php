<?php
session_start();
array_splice($_SESSION["sale_details"],intval($_POST["index"]),1);

?>
