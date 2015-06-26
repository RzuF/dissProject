<?php

class comment
{
	public $id;
	public $author;
	public $note;
	public $plus;
	public $minus;
	public $date;
	public $text;
	
	public function __construct($id_param, $mode = 0)
	{
		$this->id = $id_param;
		
		$idreq = $mode == 0 ? mysql_query("SELECT a.text, a.plus, a.minus, a.date, b.login, a.note FROM ".PREFIX."_comments a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.id = $id_param") : mysql_query("SELECT a.text, a.plus, a.minus, a.date, b.login FROM ".PREFIX."_comments a LEFT JOIN ".PREFIX."_users b ON a.author = b.id ORDER BY a.difference DESC WHERE a.note = $id_param"); // $mode =/= 0 -> get most valuable comment for specified note
		if(!$idreq) echo "Error: ".mysql_error();
		else
		{
			if($req = mysql_fetch_assoc($idreq))
			{
				$this->author = "deleted_user";
				if($req['login'] != NULL) $this->author = $req['login'];
				
				$this->plus = explode(";", $req['plus']); // Smashing string into array, previusly joined by ";" symbol
				$this->minus = explode(";", $req['minus']); // -||- -||- -||- -||- -||- -||- -||- -||- -||-
				
				$this->date = $req['date'];
				$this->text = $req['text'];
			}
		}
		
	}
	
	public function show()
	{
		// Gonna be there sth as soon as template will be ready
	}
}

?>