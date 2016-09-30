<?php
include_once __DIR__.'/../db/dbconfig.php';
if(
	!isset($_POST['result']) ||
	!isset($_POST['num_blocks']) ||
	!isset($_POST['level']) ||
	!isset($_POST['code_blocks'])
	){
	exit("{status: 'fail'}");
}
session_start();

if(!isset($_SESSION['USER'])){
	exit("{status: 'fail'}");
}
$user = $_SESSION['USER'];
$db = DbConfig::getConnection();

if(
	!is_numeric($_POST['result']) ||
	!is_numeric($_POST['num_blocks']) ||
	!is_numeric($_POST['level'])
	){
	exit("{status: 'fail'}");
}

$result = $_POST['result'];
$num_blocks = $_POST['num_blocks'];
$level = $_POST['level'];
$sql = "INSERT INTO attempt_registry (user_id, used_blocks, level, result) VALUES ('$user', '$num_blocks', '$level', '$result');";

$db->query($sql);
$db->close();
echo "{status: 'ok'}";
session_write_close();
?>
