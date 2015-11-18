<?php
/**
 * Gestisce la tabella 'Offerte_dettaglio_costi'
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
			INSERT INTO `offerte_dettaglio_costi`
			(`ofv-numoff`, `ofv-codart`, `ofv-num-riga-voce`, `datains`)		
			SELECT ?, ?, COALESCE(max(`ofv-num-riga-voce`), 0)+1, CURRENT_TIMESTAMP
			  FROM `offerte_dettaglio_costi`
		   WHERE `ofv-numoff` = ?
			   AND `ofv-codart` = ?
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('isdd', 
											$_GET['ofv_numoff'], 
											$_GET['ofv_codart'], 
											$_GET['ofv_numoff'], 
											$_GET['ofv_codart']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
	$id = $mysqli->insert_id;
	
	// RETURN id	
	echo json_encode(array('id' => $id));
} 
else if (isset($_POST['update'])) {
	// UPDATE articolo
	$query = "
			UPDATE `offerte_dettaglio_articoli`
			SET `ofa-totuni` = ?,
			    `ofa-totunit-fin` = ?,
			    `ofa-totgen` = ?
		   WHERE `ofa-numoff` = ?
			   AND `ofa-codart` = ?
	";
	$result = $mysqli->prepare($query);

	$result->bind_param('dddis', 
											$_POST['ofa_totuni'], 
											$_POST['ofa_totunit_fin'], 
											$_POST['ofa_totgen'], 
											$_POST['ofv_numoff'], 
											$_POST['ofv_codart']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	echo $res;
	
	// UPDATE voci
	$query = "
			UPDATE `offerte_dettaglio_costi`
			SET `ofv-codvoce` = ?,
			    `ofv-quantita` = ?,
					`ofv-lunghezza` = ?,
					`ofv-larghezza` = ?,
					`ofv-durata` = ?,
					`ofv-sconto` = ?,
					`ofv-valuni-cal` = ?,
					`ofv-valuni-fin` = ?,
					`ofv-valtot-fin` = ?,
					`ofv-codart-agg` = ?,
					`ofv-codart-agg-prz-lor` = ?
		   WHERE `id` = ?
	";
	$result = $mysqli->prepare($query);
	
  $arrVoci = $_POST['voci'];
	foreach ($arrVoci as $voce) {
		$result->bind_param('iiddiddddsdi', 
											$_POST['ofv_codvoce'], 
											$_POST['ofv_quantita'], 
											$_POST['ofv_lunghezza'], 
											$_POST['ofv_larghezza'], 
											$_POST['ofv_durata'], 
											$_POST['ofv_sconto'], 
											$_POST['ofv_valuni_cal'], 
											$_POST['ofv_valuni_fin'], 
											$_POST['ofv_valtot_fin'], 
											$_POST['ofv_codart_agg'], 
											$_POST['ofv_codart_agg_prz_lor'],
											$_POST['ofv_id']);
		$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
		echo $res;
	}
} 
else if (isset($_GET['delete'])) {    
	// DELETE COMMAND
	$query = "
			DELETE FROM offerte_dettaglio_costi 
			WHERE id=?
	";
	$result = $mysqli->prepare($query);
	$result->bind_param('i', $_GET['ofv_id']);
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