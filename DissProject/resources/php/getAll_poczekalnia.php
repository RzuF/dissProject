<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

if(isset($_GET['id']))
{
	$idreq = mysql_query("SELECT a.id, a.title, a.difference, a.date, b.login, a.tags, a.state FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.state = 0 OR a.state = 3");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		$arr = array();
		$arr[] = $_SESSION;
		
		while($req = mysql_fetch_assoc($idreq))
		{
			$arr[] = $req; 			
		}
		
		echo $json_response = json_encode($arr);
	}
}

?>