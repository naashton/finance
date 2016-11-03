<?php
	define(DBCONNSTRING,'mysql:host=127.0.0.1;dbname=naa5728');
	define(DBUSER, 'naa5728');
	define(DBPASS,'nyq14qn0');
	try {
		$conn= new PDO(DBCONNSTRING, DBUSER, DBPASS);
		
	} catch (PDOException $e) {
		echo $e->getMessage();}   
?>
