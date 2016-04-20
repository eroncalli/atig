<?php
/**
 * Gestisce la tabella 'Offerte_dettaglio_articoli'
 **/

//- Turn off all error reporting
error_reporting(0);

include ('connect.php');

$mysqli = new mysqli($hostname, $username, $password, $database);
$mysqli->set_charset("utf8");

if (mysqli_connect_errno()) {
	echo json_encode(array('error' => 'Errore di connessione al database.'));
	exit();
}

if (isset($_GET['insert'])) {
	// INSERT COMMAND
	$query = "
			INSERT INTO `offerte_dettaglio_articoli` 
			(`ofa-offid`, `ofa-codart`, `ofa-descart`, 
       `ofa-lungsmu`, `ofa-lunghezza`, 
       `ofa-moltipl`, `ofa-scarto`, `ofa-oneriacc`, 
       `ofa-larghezza`, `ofa-quantita`, `ofa-unimis`, 
       `ofa-przacq-net`, `ofa-przacq-lor`, `datains`) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('issddidddisdd', 
                      $_GET['ofa_offid'], 
                      $_GET['ofa_codart'], 
                      $_GET['ofa_descart'], 
                      $_GET['ofa_lungsmu'], 
                      $_GET['ofa_lunghezza'], 
                      $_GET['ofa_moltipl'], 
                      $_GET['ofa_scarto'], 
                      $_GET['ofa_oneriacc'], 
                      $_GET['ofa_larghezza'],
                      $_GET['ofa_quantita'],
                      $_GET['ofa_unimis'],
                      $_GET['ofa_przacq_net'],
                      $_GET['ofa_przacq_lor']);

  $res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
	$id = $mysqli->insert_id;
	
	// RETURN id	
	echo json_encode(array('id' => $id));
} 
else if (isset($_GET['update'])) {
	// UPDATE COMMAND
	$query = "
			UPDATE `offerte_dettaglio_articoli`
			   SET `ofa-codart` = ?,
				     `ofa-lunghezza` = ?, `ofa-larghezza` = ?, `ofa-lungsmu` = ?,
             `ofa-quantita` = ?, `ofa-unimis` = ?, 
             `ofa-przacq-net` = ?, `ofa-przacq-lor` = ?,
             `datamod` = CURRENT_TIMESTAMP
			 WHERE `id` = ?
	";
	$result = $mysqli->prepare($query);

	$result->bind_param('sdddisddi', 
											$_GET['ofa_codart'],
                      $_GET['ofa_lunghezza'],
                      $_GET['ofa_larghezza'], 
                      $_GET['ofa_lungsmu'], 
                      $_GET['ofa_quantita'],
                      $_GET['ofa_unimis'],
                      $_GET['ofa_przacq_net'],
                      $_GET['ofa_przacq_lor'],
                      $_GET['ofa_id']);

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
else if (isset($_GET['select_one'])) {
	// SELECT COMMAND
	$query = "
      SELECT t1.`id`, t1.`ofa-numoff`, t1.`ofa-codart`, t1.`ofa-descart`, t1.`ofa-lungsmu`, t3.`fam-descriz`, t1.`ofa-moltipl`, t1.`ofa-scarto`, t1.`ofa-oneriacc`, t1.`ofa-unimis`, t1.`ofa-przacq-net`, t1.`ofa-przacq-lor`, t1.`ofa-lunghezza`, t1.`ofa-larghezza`, t1.`ofa-quantita`
        FROM offerte_dettaglio_articoli t1, articoli t2, famiglie t3
       WHERE t1.`ofa-offid` = ?
         AND t1.`ofa-codart` = t2.`art-codart`
         AND t2.`art-codfam` = t3.`fam-codfam`
		ORDER BY t1.`datains`
	";
	$result = $mysqli->prepare($query);
  $result->bind_param('i', $_GET['ofa_offid']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($ofa_id, $ofa_numoff, $ofa_codart, $ofa_descart, $ofa_lungsmu, $fam_descriz, $ofa_moltipl, $ofa_scarto, $ofa_oneriacc, $ofa_unimis, $ofa_przacq_net, $ofa_przacq_lor, $ofa_lunghezza, $ofa_larghezza, $ofa_quantita);
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'ofa_id'         => $ofa_id,
			'ofa_numoff'     => $ofa_numoff,
      'ofa_codart'     => $ofa_codart,
      'ofa_descart'    => $ofa_descart,
      'ofa_lungsmu'    => $ofa_lungsmu,
			'fam_descriz'    => $fam_descriz,
      'ofa_moltipl'    => $ofa_moltipl,
      'ofa_scarto'     => $ofa_scarto,
      'ofa_oneriacc'   => $ofa_oneriacc,
      'ofa_unimis'     => $ofa_unimis,
      'ofa_przacq_net' => $ofa_przacq_net,
      'ofa_przacq_lor' => $ofa_przacq_lor,
      'ofa_lunghezza'  => $ofa_lunghezza,
      'ofa_larghezza'  => $ofa_larghezza,
      'ofa_quantita'   => $ofa_quantita
		);
	}
	echo json_encode($elements);
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