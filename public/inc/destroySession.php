<?php
// include src/Manager/sessionManager
include_once(getcwd() ."/../../src/Manager/sessionManager.php");
$session = new sessionManager();
$session->destroySession();
header("location: ../../index.php");
?>