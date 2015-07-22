<?php

include_once('config.php');

try
{
	$sqlcon = new PDO(DSN, USER, PASS);

}
catch (PDOException $e)
{
	print "Connection Error!: " . $e->getMessage() . "<br/>";
	die();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


if($request->request == "mainPage")
{
	try
	{
		$arr = array();

		foreach ($sqlcon->query("SELECT a.id, a.title, a.difference, a.date, b.login, a.tags, (SELECT COUNT(*) FROM ".PREFIX."_comments c WHERE c.note = a.id) AS comments FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.state = 1 ORDER BY a.date DESC") as $req)
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

/*
 * What you have to send in data:
 *
 * $request = 'mainPage';
 *
 * What I send back:
 *
 * JSON encoded array
 */

if($request->request == "waitPage")
{
	try
	{
		$arr = array();

		foreach ($sqlcon->query("SELECT a.id, a.title, a.difference, a.date, b.login, a.tags, a.state, (SELECT COUNT(*) FROM ".PREFIX."_comments c WHERE c.note = a.id) AS comments FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.state = 0 OR a.state = 3 ORDER BY a.date DESC") as $req)
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

/*
 * What you have to send in data:
 *
 * $request = 'waitPage';
 *
 * What I send back:
 *
 * JSON encoded array
 */

$sqlcon = null;

?>
