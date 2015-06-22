<?php

include_once('config.php');
include_once('noteClass.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

if(isset($_GET['id']))
{
	//mysql_query("SELECT a.title, a.plus, a.minus, a.date, b.login, a.source FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.id = " . $_GET['id']);
	//$obj = new note($_GET['id']);
	
	$idreq = mysql_query("SELECT a.title, a.plus, a.minus, a.date, b.login, a.source FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.id = "  . $_GET['id']);
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		$req = mysql_fetch_assoc($idreq);
		echo $json_response = json_encode($row);
	}
}

?>