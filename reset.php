<?php
// this script will drop the table evaluations
// triggered by clicking the reset button on charts.html

require_once('sesame.php');


// drop table
try {
	
	// prepare sql statement to add form data
	$sql = 'DROP TABLE IF EXISTS evaluations';

	// prepare PDO 
	$statement = $db->prepare($sql);
	
	// execute statement
	$statement->execute();

	// close connection
	$statement->closeCursor();

   // echo out a statement
}

catch (Exception $error) {
	echo "There was a problem with the drop sql statement.";
	$statement->getMessage();
}



// recreate table
try {
	
	// prepare sql statement to add form data
	$sql = 'CREATE TABLE evaluations (question VARCHAR(4), yes VARCHAR(1), no VARCHAR(1), unsure VARCHAR(1))';

	// prepare PDO 
	$statement = $db->prepare($sql);
	
	// execute statement
	$statement->execute();

	// close connection
	$statement->closeCursor();

   // echo out a statement
   echo "['msg': 'reset']";
}

catch (Exception $error) {
	echo "There was a problem with the create sql statement.";
	$statement->getMessage();
}
