<?php

class note
{
	public $id;
	public $title;
	public $plus;
	public $minus;
	public $date;
	public $author;
	public $source;
	public $state;
	
	public function __construct($id_param, $mode = 0)
	{
		$this->id = $id_param;
	    
		$idreq = $mode == 0 ? mysql_query("SELECT `title`, `plus`, `minus`, `date`, `author`, `source` FROM `".PREFIX."_notes` WHERE `id` = '".$id_param."'") : mysql_query("SELECT `title`, `plus`, `minus`, `date`, `author`, `source`, `state` FROM `".PREFIX."_notes` WHERE `id` = '".$id_param."'"); // Zapytanie o dane obrazka o otrzymanym ID
		//mysql_query("SELECT `a.title`, `a.plus`, `a.minus`, `a.date`, `b.login`, `a.source` FROM `".PREFIX."_notes` a LEFT JOIN `".PREFIX."_users` b ON a.author = b.id WHERE `id` = '".$id_param."'") WILL BE TESTED!
		if(!$idreq) echo "Error: ".mysql_error();
		else
		{
			if($req = mysql_fetch_assoc($idreq))
			{
				$this->author = "deleted_user";
				$idreq2 = mysql_query("SELECT `login` FROM `".PREFIX."_users` WHERE `id` = '".$req['uploader']."'");
				if(!$idreq) echo "Error: ".mysql_error();
				else
				{
					$req2 = mysql_fetch_assoc($idreq2);
					$this->author = $req2['login'];
				}
		
				$this->plus = explode(";", $req['plus']); // Smashing string into array, previusly joined by ";" symbol
				$this->minus = explode(";", $req['minus']); // -||- -||- -||- -||- -||- -||- -||- -||- -||-
				
				$this->date = $req['date'];
				$this->source = $req['source'];
				$this->title = $req['title'];
				$this->state = isset($req['state']) ? $req['state'] : NULL;
			}
		}
	}
	
	public function show()
	{
		// Gonna be thare sth soon!
	}
}

?>