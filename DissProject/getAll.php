<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

if(isset($_GET['id']))
{
	$idreq = mysql_query("SELECT a.id, a.title, a.plus, a.minus, a.date, b.login, a.tags FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		$arr = array();
		
		while($req = mysql_fetch_assoc($idreq))
		{
			$arr[] = $req; 			
		}
		
		//echo $arr;
		echo $json_response = json_encode($arr);
	}
}

?>