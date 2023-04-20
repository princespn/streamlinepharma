<?php
session_start();
if(!isset($_SESSION['id'])&&$_SESSION['type']!='admin'){
	header("location:index.php");
	exit;
}