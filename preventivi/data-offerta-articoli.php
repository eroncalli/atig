<?php
/**
 * Gestisce la tabella 'Offerte_dettaglio_articoli'
 **/

//- Turn off all error reporting
// error_reporting(0);

include ('connect.php');

$mysqli = new mysqli($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
	echo json_encode(array('error' => 'connection'));
	exit();
}

if (isset($_GET['insert'])) {
	// INSERT COMMAND
	$query = "
			INSERT INTO `offerte_dettaglio_articoli` 
			(`ofa-numoff`, `ofa-codart`, `ofa-lunghezza`, `ofa-larghezza`, `datains`) 
			VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('isdd', $_GET['ofa_numoff'], $_GET['ofa_codart'], $_GET['ofa_lunghezza'], $_GET['ofa_larghezza']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
	echo $res;
} 
else if (isset($_GET['update'])) {
	// UPDATE COMMAND
	$query = "
			UPDATE `offerte_dettaglio_articoli`
			   SET `ofa-lunghezza` = ?, `ofa-larghezza` = ? 
			 WHERE `ofa-numoff` = ?
		     AND `ofa-codart` = ?
	";
	$result = $mysqli->prepare($query);

	$result->bind_param('ddis', $_GET['ofa_lunghezza'], $_GET['ofa_larghezza'], $_GET['ofa_numoff'], $_GET['ofa_codart']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("Updated Record has id %d.\n", $_GET['EmployeeID']);
	echo $res;
} 
else if (isset($_GET['delete'])) {    //...TODO
	// DELETE COMMAND
	$query = "DELETE FROM employees WHERE EmployeeID=?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['EmployeeID']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("Deleted Record has id %d.\n", $_GET['EmployeeID']);
	echo $res;
}
else {   //...TODO
	// SELECT COMMAND
	$query = "SELECT `off-numoff`, `off-codcli`, `off-datains`, `off-dataeva` FROM offerte";
	$result = $mysqli->prepare($query);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_numoff, $off_codcli, $off_datains, $off_dataeva);
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'off_numoff'  => $off_numoff,
			'off_codcli'  => $off_codcli,
			'off_datains' => $off_datains,
			'off_dataeva' => $off_dataeva
		);
	}
	echo json_encode($elements);
}

$result->close();
$mysqli->close();

?>