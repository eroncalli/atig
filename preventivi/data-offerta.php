<?php
/**
 * Gestisce la tabella 'Offerta'
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
	$datains = null;
	$dataeva = null;
	if (isset($_GET['off_datains'])) {
		//$d_ins = DateTime::createFromFormat("d/m/Y", $_GET['off_datains']);
		//$datains = $d_ins->format('Y-m-d');
		$valoriDate = explode("/", $_GET['off_datains']);
		$datains = $valoriDate[2]. "-" . $valoriDate[1]. "-" . $valoriDate[0];
	}

	if (isset($_GET['off_dataeva']) and ($_GET['off_dataeva'] != "")) {
		//$d_eva = DateTime::createFromFormat("d/m/Y", $_GET['off_dataeva']);
		//$dataeva = $d_eva->format('Y-m-d');
		$valoriDateEva = explode("/", $_GET['off_dataeva']);
		$dataeva = $valoriDateEva[2]. "-" . $valoriDateEva[1]. "-" . $valoriDateEva[0];
	}
	echo $dataeva;
	// INSERT COMMAND
	$query = "
			INSERT INTO offerte (`off-numoff`, `off-codcli`, `off-datains`, `off-dataeva`, `datains`) 
			SELECT COALESCE(max(`off-numoff`),0)+1, ?, ?, ?, CURRENT_TIMESTAMP 
			FROM offerte
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('sss', $_GET['off_codcli'], $datains, $dataeva);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
  $id = $mysqli->insert_id;
	
	// RETURN off-numoff
	$query = "SELECT `off-numoff` FROM offerte WHERE id = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $id);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_numoff);
	
	/* fetch first value */
	while ($result->fetch()) {
		$elements[] = array(
			'off_numoff'  => $off_numoff,
		);
	}
	echo json_encode($elements);
} 
else if (isset($_GET['update'])) {  //...TODO
	// UPDATE COMMAND
	$query = "UPDATE `employees` SET `FirstName`=?, `LastName`=?, `Title`=?, `Address`=?, `City`=?, `Country`=?, `Notes`=? WHERE `EmployeeID`=?";
	$result = $mysqli->prepare($query);
	$result->bind_param('sssssssi', $_GET['FirstName'], $_GET['LastName'], $_GET['Title'], $_GET['Address'], $_GET['City'], $_GET['Country'], $_GET['Notes'], $_GET['EmployeeID']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("Updated Record has id %d.\n", $_GET['EmployeeID']);
	echo $res;
} 
else if (isset($_GET['delete'])) {   //...TODO
	// DELETE COMMAND
	$query = "DELETE FROM employees WHERE EmployeeID=?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['EmployeeID']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("Deleted Record has id %d.\n", $_GET['EmployeeID']);
	echo $res;
}
else {
	// SELECT COMMAND
	$query = "
			SELECT `off-numoff`, `off-codcli`, `off-datains`, `off-dataeva` 
			FROM offerte
	";
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