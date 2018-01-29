<?php
	define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=naa5728');
	define(DBUSER, '');
	define(DBPASS,'');
	try {
		$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		
	} catch (PDOException $e) {
		echo $e->getMessage();}   
?>
