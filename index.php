<?php
require_once("src/controller/LoginController.php");
require_once("src/controller/DashboardController.php");

$login = new LoginController();
$dashboard = new DashboardController();

if(isset($_POST['login'])){
	$login->login();
}
else if(isset($_POST['export'])){
	$dashboard->export_To_CSV();
}
else{
	$login->on_Load();
}

?>