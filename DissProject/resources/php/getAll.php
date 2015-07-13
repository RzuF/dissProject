<?php

include_once('config.php');

session_start();

try
{
	$sqlcon = new PDO(DSN, USER, PASS);

}
catch (PDOException $e)
{
	print "Connection Error!: " . $e->getMessage() . "<br/>";
	die();
}

if(isset($_GET['id']))
{
	try
	{
		$arr = array();

		foreach ($sqlcon->query("SELECT a.id, a.title, a.difference, a.date, b.login, a.tags FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.state = 1") as $req)
		{
			$arr[] = $req;
		}

		echo $json_response = json_encode($arr);
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

$sqlcon = null;

?>