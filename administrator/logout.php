<?php
session_start();
ob_start();
session_destroy();
header("Refresh: 0; url=pages-sign-in.php");
ob_end_flush();
?>