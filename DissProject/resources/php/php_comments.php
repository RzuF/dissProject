<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


if($request->request == "add")
{
	$uploadOk = true;
	
	if($request->commentText == "")
	{
		echo "ERROR: Pole tekst nie mo¿e byæ puste\n";
		$uploadOk = false;
	}
	
	if ($uploadOk)
	{
		$idreq = mysql_query("INSERT INTO `".PREFIX."_comments`(`id`, `text`, `author`, `date`, `note`, `id`) VALUES ('', '".htmlentities($request->dissText)."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '".$request->id."', '".$_SERVER['REMOTE_ADDR']."')");
		$l_id = mysql_insert_id();
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK: $l_id";		
	}		
}

/*
 * What you have to send in data:
 *
 * $request = 'add';
 * $id; (note ID)
 *
 * What I send back:
 *
 * 'OK: ID' if was successful & ID inserted item
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "addAnon")
{
	// In future!
}

/*
 * What you have to send in data:
 *
 * $request = 'addAnon';
 * $id; (note ID)
 *
 * What I send back:
 *
 * 'OK: ID' if was successful & ID inserted item
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "delete")
{
	if($_SESSION['active'] > 2)
	{
		$idreq = mysql_query("DELETE FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'");
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK";
	}
	else echo "ERROR: Nie masz takich uprawnieñ";
}

/*
 * What you have to send in data:
 *
 * $request = 'delete';
 * $id;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */