<?php
// this script will look at the URL query parameters and extract the relevant GET data.
// then will insert record to database.
// basically this is my own serverless api

session_start();
require_once('sesame.php');

// get data GET request in URL
// data are the answers (yes=y, no=n, unsure=u) to each question found
// on "Evaluating a Resource" library exercise
// q1 - does source include keywords in title/subject 
// q2 - is source published in required timeframe
// q3 - does type of resource scholarly
// q4 - does abstract/toc reflect what I need
// q5 is this source useful


try {

	foreach($_GET as $rq => $rq_value) {

		// prepare sql statement to add form data, this changes depending on user's answer of y/n/u'
		switch ($rq_value) {
			case 'y':
				$sql = 'INSERT INTO evaluations (question, yes) VALUES (:rq, "y")';
				break;
			case 'n':
				$sql = 'INSERT INTO evaluations (question, no) VALUES (:rq, "n")';
				break;
			default:
				$sql = 'INSERT INTO evaluations (question, unsure) VALUES (:rq, "u")';
		}


		// prepare PDO 
		$statement = $db->prepare($sql);

		// don't need to bind values
		$statement->bindValue(':rq', $rq);

		// execute statement
		$statement->execute();
		
	}


	// close connection
	$statement->closeCursor();

}

catch (Exception $error) {
	echo "There was a problem with the delete sql statement.";
	$statement->getMessage();
}

?>