<?php
/**
 * Gestisce la tabella 'Offerta'
 **/

function cleanDB($mysqli) {
	// DELETE COMMAND
	$del1 = "
		DELETE FROM offerte_dettaglio_costi 
		WHERE `ofv-codvoce` IS NULL
	";
	
	$del2 = "
		DELETE FROM offerte_dettaglio_articoli
		WHERE `ofa-numoff` IN (
			SELECT `off-numoff`
			FROM offerte 
			WHERE `off-stato` = 'Z'
		)
	";
	
	$del3 = "
		DELETE FROM offerte_dettaglio_costi 
		WHERE `ofv-numoff` IN (
			SELECT `off-numoff`
			FROM offerte 
			WHERE `off-stato` = 'Z'
		)
	";
	
	$del4 = "
		DELETE FROM offerte 
		WHERE `off-stato` = 'Z'
	";
	
	$result = $mysqli->prepare($del1);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	$result = $mysqli->prepare($del2);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	$result = $mysqli->prepare($del3);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);	
	
	$result = $mysqli->prepare($del4);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);	
}

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
	cleanDB($mysqli);
		
	$datains = null;
	$dataeva = null;
	$year    = 0;
	if (isset($_GET['off_datains'])) {
		//$d_ins = DateTime::createFromFormat("d/m/Y", $_GET['off_datains']);
		//$datains = $d_ins->format('Y-m-d');
		$valoriDate = explode("/", $_GET['off_datains']);
		$datains = $valoriDate[2]. "-" . $valoriDate[1]. "-" . $valoriDate[0];
		$year = $valoriDate[2];
	}

	if (isset($_GET['off_dataeva']) and ($_GET['off_dataeva'] != "")) {
		//$d_eva = DateTime::createFromFormat("d/m/Y", $_GET['off_dataeva']);
		//$dataeva = $d_eva->format('Y-m-d');
		$valoriDateEva = explode("/", $_GET['off_dataeva']);
		$dataeva = $valoriDateEva[2]. "-" . $valoriDateEva[1]. "-" . $valoriDateEva[0];
	}
	
	// INSERT COMMAND
	$query = "
			INSERT INTO offerte (`off-numoff`, `off-codcli`, `off-datains`, `off-dataeva`, `off-gg-termine-consegna`, `off-descriz`, `datains`) 
			SELECT COALESCE(max(`off-numoff`),0)+1, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP 
			FROM offerte
			WHERE year(`off-datains`) = ?
	";
	$result = $mysqli->prepare($query);

	$result->bind_param('sssisi', $_GET['off_codcli'], $datains, $dataeva, $_GET['off_gg'],  $_GET['off_descriz'], $year);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
  $id = $mysqli->insert_id;
	
	// RETURN off-numoff
	$query = "SELECT `id`, `off-numoff` FROM offerte WHERE id = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $id);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_id, $off_numoff);
	
	/* fetch first value */
	while ($result->fetch()) {
		$elements[] = array(
			'off_id'      => $off_id, 
			'off_numoff'  => $off_numoff
		);
	}
	echo json_encode($elements);
} 
else if (isset($_GET['clone'])) {
  $query = "
      INSERT INTO offerte (`off-numoff`, `off-codcli`, `off-descriz`, `off-datains`, `datains`) 
			SELECT (
			         SELECT COALESCE(max(`off-numoff`),0)+1 
					     FROM offerte 
					     WHERE year(`off-datains`) = year(CURRENT_TIMESTAMP)
				     ), 
             `off-codcli`, 
             `off-descriz`,
             CURRENT_TIMESTAMP,
             CURRENT_TIMESTAMP
      FROM `offerte` 
      WHERE `id` = ?
  ";
  $result = $mysqli->prepare($query);
	
	$query = "
		INSERT INTO `offerte_dettaglio_articoli` 
					(`ofa-offid`, `ofa-codart`, `ofa-descart`, `ofa-lungsmu`, `ofa-tiposmu`, `ofa-moltipl`, `ofa-oneriacc`, `ofa-scarto`, `ofa-lunghezza`, `ofa-larghezza`, `ofa-spessore`, `ofa-quantita`, `ofa-unimis`, `ofa-przacq-net`, `ofa-przacq-lor`, `ofa-totuni`, `ofa-totunit-fin`, `ofa-totgen`, `ofa-przven`, `datains`)
		SELECT ?,           `ofa-codart`, `ofa-descart`, `ofa-lungsmu`, `ofa-tiposmu`, `ofa-moltipl`, `ofa-oneriacc`, `ofa-scarto`, `ofa-lunghezza`, `ofa-larghezza`, `ofa-spessore`, `ofa-quantita`, `ofa-unimis`, `ofa-przacq-net`, `ofa-przacq-lor`, `ofa-totuni`, `ofa-totunit-fin`, `ofa-totgen`, `ofa-przven`, CURRENT_TIMESTAMP
		FROM `offerte_dettaglio_articoli` 
		WHERE `id` = ?
	";
	$result2 = $mysqli->prepare($query);
	
	$query = "
		INSERT INTO `offerte_dettaglio_costi` 
					(`ofv-ofaid`, `ofv-codvoce`, `ofv-desc-manuale`, `ofv-semanual`, `ofv-quantita`, `ofv-lunghezza`, `ofv-larghezza`, `ofv-spessore`, `ofv-przacq`, `ofv-sconto`, `ofv-valuni-cal`, `ofv-valuni-fin`, `ofv-num-riga-voce`, `ofv-durata`, `ofv-codart`, `ofv-valtot-fin`, `ofv-codart-agg`, `ofv-codart-agg-prz-lor`, `ofv-descriz`, `ofv-formula`, `ofv-desc-formula`, `ofv-critcalc`, `ofv-costo`, `ofv-desc1`, `ofv-desc2`, `datains`)
		SELECT ?,           `ofv-codvoce`, `ofv-desc-manuale`, `ofv-semanual`, `ofv-quantita`, `ofv-lunghezza`, `ofv-larghezza`, `ofv-spessore`, `ofv-przacq`, `ofv-sconto`, `ofv-valuni-cal`, `ofv-valuni-fin`, `ofv-num-riga-voce`, `ofv-durata`, `ofv-codart`, `ofv-valtot-fin`, `ofv-codart-agg`, `ofv-codart-agg-prz-lor`, `ofv-descriz`, `ofv-formula`, `ofv-desc-formula`, `ofv-critcalc`, `ofv-costo`, `ofv-desc1`, `ofv-desc2`, CURRENT_TIMESTAMP
		FROM `offerte_dettaglio_costi` 
		WHERE `ofv-ofaid` = ?
	";
	$result3 = $mysqli->prepare($query);	
	
	// CLONA OFFERTA
	$result->bind_param('i', $_GET['off_id']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
  $new_off_id = $mysqli->insert_id;
 
	
	//-Cicla tutti gli articoli, per ogni articolo clona i costi
	$query = "SELECT `id` FROM `offerte_dettaglio_articoli` WHERE `ofa-offid` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_id']);
	$result->execute();	
	
	$res = $result->get_result();
	$ids = $res->fetch_array(MYSQLI_NUM);
	$result->free_result();
	
	foreach ($ids as $old_ofa_id) {
		// CLONA OFFERTA-ARTICOLI
		$result2->bind_param('ii', $new_off_id, $old_ofa_id);
		$res = $result2->execute() or trigger_error($result2->error, E_USER_ERROR);
		// printf ("New Record has id %d.\n", $mysqli->insert_id);
		$new_ofa_id = $mysqli->insert_id;
		
		// CLONA OFFERTA-COSTI
		$result3->bind_param('ii', $new_ofa_id, $old_ofa_id);
		$res = $result3->execute() or trigger_error($result3->error, E_USER_ERROR);
		// printf ("New Record has id %d.\n", $mysqli->insert_id);
	}
	
  // RETURN id e off-numoff
	$query = "SELECT `id`, `off-numoff` FROM offerte WHERE id = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $new_off_id);
	$result->execute();
  
  /* bind result variables */
	$result->bind_result($off_id, $off_numoff);
  
  /* fetch first value */
	while ($result->fetch()) {
		$elements[] = array(
			'off_id'      => $off_id,
			'off_numoff'  => $off_numoff
		);
	}
	echo json_encode($elements);
}
else if (isset($_GET['update'])) {
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
  
	// UPDATE COMMAND
	$query = "
        UPDATE `offerte` 
        SET `off-codcli` = ?, 
					`off-datains` = ?, 
					`off-dataeva` = ?, 
					`datamod` = CURRENT_TIMESTAMP, 
					`off-gg-termine-consegna`= ?, 
					`off-descriz` = ?
        WHERE `id` = ?
  ";
	$result = $mysqli->prepare($query);
	$result->bind_param('sssisi', $_GET['off_codcli'], $datains, $dataeva, $_GET['off_gg'], $_GET['off_descriz'], $_GET['off_id']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
}
else if (isset($_GET['update_stato_salva'])) {
	// UPDATE COMMAND
	$query = "UPDATE `offerte` SET `off-stato` = 0, `datamod` = CURRENT_TIMESTAMP WHERE `id` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_id']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
	cleanDB($mysqli);
} 
else if (isset($_GET['update_stato'])) {
	// UPDATE COMMAND
	$query = "UPDATE `offerte` SET `off-stato` = 1, `datamod` = CURRENT_TIMESTAMP WHERE `id` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_id']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);

	echo $res;
	cleanDB($mysqli);
} 
else if (isset($_GET['delete_logic'])) {
	// LOGIC DELETE COMMAND
	$query = "UPDATE `offerte` SET `off-stato` = 2, `datamod` = CURRENT_TIMESTAMP WHERE `id` = ?";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['off_id']);
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
      SELECT t1.`off-numoff`, t1.`off-datains`, t1.`off-dataeva`, t1.`off-gg-termine-consegna`, t1.`off-descriz`, t1.`off-codcli`, t2.`cli-ragsoc`
        FROM (offerte t1 INNER JOIN clienti t2 ON t1.`off-codcli` = t2.`cli-codcli`)
       WHERE t1.`id` = ?
	";
	$result = $mysqli->prepare($query);
  $result->bind_param('i', $_GET['off_id']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_numoff, $off_datains, $off_dataeva, $off_gg_termine_consegna, $off_descriz, $off_codcli,  $cli_ragsoc);
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'off_numoff'  => $off_numoff,
      'off_datains' => $off_datains,
      'off_dataeva' => $off_dataeva,
			'off_gg'      => $off_gg_termine_consegna,
			'off_descriz' => $off_descriz,
			'off_codcli'  => $off_codcli,
      'cli_ragsoc'  => $cli_ragsoc
		);
	}
	echo json_encode($elements);
}
else {
	// SELECT COMMAND
	$query = "
      SELECT t1.`id`, t1.`off-numoff`,  t1.`off-descriz`, t1.`off-datains`, t1.`off-codcli`, t2.`cli-ragsoc`, sum(t3.`ofa-totgen`) totgen
        FROM (offerte t1 INNER JOIN clienti t2 ON t1.`off-codcli` = t2.`cli-codcli`) INNER JOIN offerte_dettaglio_articoli t3 ON t1.`id` = t3.`ofa-offid`
       WHERE t1.`off-stato` = ?
			   AND UPPER(CONCAT(t1.`off-numoff`, ' ', t1.`off-descriz`, ' ', t1.`off-datains`, ' ', t1.`off-codcli`, ' ',  t2.`cli-ragsoc`)) LIKE CONCAT('%',UPPER(?),'%')
    GROUP BY t1.`off-numoff`,  t1.`off-datains`, t1.`off-codcli`, t2.`cli-ragsoc`
    ORDER BY t1.`off-datains` DESC, t1.`off-numoff` DESC
	";

	$result = $mysqli->prepare($query);
  $result->bind_param('ss', $_GET['off_stato'], $_GET['filtro']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($off_id, $off_numoff, $off_descriz, $off_datains, $off_codcli,  $cli_ragsoc, $totgen);
	
	$elements = array();
	
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'off_id'      => $off_id,
			'off_numoff'  => $off_numoff,
			'off_descriz' => $off_descriz,
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