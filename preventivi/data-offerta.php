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
else if (isset($_GET['update_stato'])) {
	// UPDATE COMMAND
	$query = "UPDATE `offerte` SET `off-stato` = 1 WHERE `off-numoff` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_numoff']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
} 
else if (isset($_GET['delete_logic'])) {
	// LOGIC DELETE COMMAND
	$query = "UPDATE `offerte` SET `off-stato` = 2 WHERE `off-numoff` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_numoff']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
}
else if (isset($_GET['delete_hard'])) {
	// HARD DELETE COMMAND
	$query = "DELETE FROM `offerte` WHERE `off-numoff` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_numoff']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
}
else if (isset($_GET['select_one'])) {
	// SELECT COMMAND
	$query = "
      SELECT t1.`off-numoff`, t1.`off-datains`, t1.`off-dataeva`, t1.`off-codcli`, t2.`cli-ragsoc`
        FROM (offerte t1 INNER JOIN clienti t2 ON t1.`off-codcli` = t2.`cli-codcli`)
       WHERE t1.`off-numoff` = ?
	";
	$result = $mysqli->prepare($query);
  $result->bind_param('i', $_GET['off_numoff']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_numoff, $off_datains, $off_dataeva, $off_codcli,  $cli_ragsoc);
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'off_numoff'  => $off_numoff,
      'off_datains' => $off_datains,
      'off_dataeva' => $off_dataeva,
			'off_codcli'  => $off_codcli,
      'cli_ragsoc'  => $cli_ragsoc
		);
	}
	echo json_encode($elements);
}
else {
	// SELECT COMMAND
	$query = "
      SELECT t1.`off-numoff`,  t1.`off-datains`, t1.`off-codcli`, t2.`cli-ragsoc`, sum(t3.`ofa-totgen`) totgen
        FROM (offerte t1 INNER JOIN clienti t2 ON t1.`off-codcli` = t2.`cli-codcli`) INNER JOIN offerte_dettaglio_articoli t3 ON t1.`off-numoff` = t3.`ofa-numoff`
       WHERE t1.`off-stato` = ?
    GROUP BY t1.`off-numoff`,  t1.`off-datains`, t1.`off-codcli`, t2.`cli-ragsoc`
    ORDER BY t1.`off-numoff` DESC
	";
	$result = $mysqli->prepare($query);
  $result->bind_param('i', $_GET['off_stato']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_numoff, $off_datains, $off_codcli,  $cli_ragsoc, $totgen);
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'off_numoff'  => $off_numoff,
      'off_datains' => $off_datains,
			'off_codcli'  => $off_codcli,
      'cli_ragsoc'  => $cli_ragsoc,
      'totgen'      => $totgen
		);
	}
	echo json_encode($elements);
}

$result->close();
$mysqli->close();

?>