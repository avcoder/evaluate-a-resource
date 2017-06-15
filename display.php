<?php
// this script will query the database in order to sum all the YES/NO answers for the library exercise,
// "Evaluating a Resource".  The results will be displayed


require_once('sesame.php');




try {

	// prepare sql statements to sum form data
   $sql = 'SELECT question, COUNT(yes) as yes, COUNT(NO) as no, COUNT(unsure) as unsure, COUNT(*) as count FROM evaluations GROUP BY question';
   $sql_count = '';

	// prepare PDO 
   $statement = $db->prepare($sql);
   //$statement_count = $db->prepare($sql_count);

   // execute statement
   $statement->execute();
   //$statement_count->execute();

   // see https://phpdelusions.net/pdo/fetch_modes  for different FETCH modes
   $getData = $statement->fetchAll(PDO::FETCH_GROUP);
   //$count = $statement_count->fetch();

   $json_obj = json_encode($getData);

   echo $json_obj;

   // close connection
	$statement->closeCursor();
   //$statement_count->closeCursor();

}

catch (Exception $error) {
	echo "There was a problem with the delete sql statement.";
   $statement->getMessage();
   $statement_count->getMessage();
}




?>