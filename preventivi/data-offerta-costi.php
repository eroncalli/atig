<?php
/**
 * Gestisce la tabella 'Offerte_dettaglio_costi'
 **/

//- Turn off all error reporting
error_reporting(0);

include ('connect.php');

$mysqli = new mysqli($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
	echo json_encode(array('error' => 'Errore di connessione al database.'));
	exit();
}

if (isset($_GET['insert'])) {
	// INSERT COMMAND
	$query = "
			INSERT INTO `offerte_dettaglio_costi`
			(`ofv-ofaid`, `ofv-codart`, `ofv-num-riga-voce`, `datains`)	
      VALUES (?, ?, ?, CURRENT_TIMESTAMP)
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('isd', 
											$_GET['ofv_ofaid'], 
											$_GET['ofv_codart'], 
                      $_GET['ofv_num_riga_voce']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
	$id = $mysqli->insert_id;
	
	// RETURN id	
	echo json_encode(array('id' => $id));
} 
elseif (isset($_GET['insertArticolo'])) {
	//===========================================
  // IMPORTANTE
  // ----------
  // Il ofv-codvoce dell'articolo deve essere 1
  //===========================================
	$query = "
			INSERT INTO `offerte_dettaglio_costi`
			(`ofv-ofaid`, `ofv-codart`, `ofv-codvoce`, `ofv-num-riga-voce`, `datains`)	
      VALUES (?, ?, 1, 1, CURRENT_TIMESTAMP)
	";
	$result = $mysqli->prepare($query);
		
	$result->bind_param('is', 
											$_GET['ofv_ofaid'], 
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
		   WHERE `id` = ?
	";
	$result = $mysqli->prepare($query);

	$result->bind_param('dddi', 
											$_POST['ofa_totuni'], 
											$_POST['ofa_totunit_fin'], 
											$_POST['ofa_totgen'], 
											$_POST['ofv_ofaid']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	echo $res;
	
	// UPDATE voci
	$query = "
			UPDATE `offerte_dettaglio_costi`
			SET `ofv-codvoce` = ?,
			    `ofv-quantita` = ?,
					`ofv-lunghezza` = ?,
					`ofv-larghezza` = ?,
          `ofv-spessore` = ?,
					`ofv-durata` = ?,
					`ofv-sconto` = ?,
					`ofv-valuni-cal` = ?,
					`ofv-valuni-fin` = ?,
					`ofv-valtot-fin` = ?,
					`ofv-codart-agg` = ?,
					`ofv-codart-agg-prz-lor` = ?,
          `ofv-descriz` = ?,
          `ofv-formula` = ?,
          `ofv-desc-formula` = ?,
          `ofv-critcalc` = ?,
          `ofv-costo` = ?,
          `ofv-dimsmusso` = ?,
          `ofv-desc1` = ?,
          `ofv-desc2` = ?,
          `ofv-desc3` = ?,
          `datamod` = CURRENT_TIMESTAMP
      WHERE `id` = ?
	";
	$result = $mysqli->prepare($query);
	
  $arrVoci = $_POST['voci'];
	foreach ($arrVoci as $voce) {
    
		$result->bind_param('iidddiddddsdsissddsssi', 
											$voce['ofv_codvoce'], 
											$voce['ofv_quantita'], 
											$voce['ofv_lunghezza'], 
											$voce['ofv_larghezza'],
                      $voce['ofv_spessore'],
											$voce['ofv_durata'], 
											$voce['ofv_sconto'], 
											$voce['ofv_valuni_cal'], 
											$voce['ofv_valuni_fin'], 
											$voce['ofv_valtot_fin'], 
											$voce['ofv_codart_agg'], 
											$voce['ofv_codart_agg_prz_lor'],
											$voce['ofv_descriz'],
											$voce['ofv_formula'],
											$voce['ofv_desc_formula'],
											$voce['ofv_critcalc'],
											$voce['ofv_costo'],
											$voce['ofv_dimsmusso'],
											$voce['ofv_desc1'],
											$voce['ofv_desc2'],
											$voce['ofv_desc3'],
											$voce['ofv_id']);
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
else {
	// SELECT COMMAND
	$query = "
  SELECT `id`, `ofv-num-riga-voce`, `ofv-codvoce`,
         `ofv-quantita`, `ofv-lunghezza`, `ofv-larghezza`,
         `ofv-spessore`, `ofv-durata`, `ofv-sconto`,
         `ofv-valuni-cal`, `ofv-valuni-fin`, `ofv-valtot-fin`,
         `ofv-codart-agg`, `ofv-codart-agg-prz-lor`,
         `ofv-descriz`, `ofv-formula`, `ofv-desc-formula`,
         `ofv-critcalc`, `ofv-costo`, `ofv-dimsmusso`,
         `ofv-desc1`, `ofv-desc2`, `ofv-desc3`
    FROM `offerte_dettaglio_costi` 
   WHERE `ofv-ofaid` = ?
ORDER BY `ofv-num-riga-voce`
  ";
	$result = $mysqli->prepare($query);
  $result->bind_param('i', $_GET['ofv_ofaid']);
	$result->execute();
	  
	/* bind result variables */
	$result->bind_result($id, $ofv_num_riga_voce, $ofv_codvoce, $ofv_quantita, $ofv_lunghezza, $ofv_larghezza, $ofv_spessore, $ofv_durata, $ofv_sconto, $ofv_valuni_cal, $ofv_valuni_fin, $ofv_valtot_fin, $ofv_codart_agg, $ofv_codart_agg_prz_lor, $ofv_descriz, $ofv_formula, $ofv_desc_formula, $ofv_critcalc, $ofv_costo, $ofv_dimsmusso, $ofv_desc1, $ofv_desc2, $ofv_desc3);
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
      'id'                     => $id, 
      'ofv_num_riga_voce'      => $ofv_num_riga_voce,
      'ofv_codvoce'            => $ofv_codvoce, 
      'ofv_quantita'           => $ofv_quantita,
      'ofv_lunghezza'          => $ofv_lunghezza,
      'ofv_larghezza'          => $ofv_larghezza,
      'ofv_spessore'           => $ofv_spessore,
      'ofv_durata'             => $ofv_durata,
      'ofv_sconto'             => $ofv_sconto,
      'ofv_valuni_cal'         => $ofv_valuni_cal,
      'ofv_valuni_fin'         => $ofv_valuni_fin,
      'ofv_valtot_fin'         => $ofv_valtot_fin,
      'ofv_codart_agg'         => $ofv_codart_agg,
      'ofv_codart_agg_prz_lor' => $ofv_codart_agg_prz_lor,
      'ofv_descriz'            => $ofv_descriz,
      'ofv_formula'            => $ofv_formula,
      'ofv_desc_formula'       => $ofv_desc_formula,
      'ofv_critcalc'           => $ofv_critcalc,
      'ofv_costo'              => $ofv_costo,
      'ofv_dimsmusso'          => $ofv_dimsmusso,
      'ofv_desc1'              => $ofv_desc1,
      'ofv_desc2'              => $ofv_desc2,
      'ofv_desc3'              => $ofv_desc3
		);
	}
	echo json_encode($elements);
}

$result->close();
$mysqli->close();

?>