<?php

include_once("class/db.php");

$db = new db();


			$query = $db->runQuery("CREATE TABLE IF NOT EXISTS searches
			(id INT(11) AUTO_INCREMENT NOT NULL, 
			city VARCHAR(255) NOT NULL,
			temp VARCHAR(255) NOT NULL,
			sunrise VARCHAR(255) NOT NULL,
			sunset VARCHAR(255) NOT NULL,
			date DATETIME NOT NULL, 
			PRIMARY KEY(id)
			)
			ENGINE=MyISAM  DEFAULT CHARSET=utf8
			");
		if (!$query){
			echo "An error occured. Please try again";
			exit();
			}
			else {
				echo "Table created successfully";
				exit();
				}

?>