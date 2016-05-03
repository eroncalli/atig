<?php
/**
 * Viste sul DB
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

$vistaClienti = "
		SELECT `cli-codcli`, `cli-ragsoc` FROM clienti
";

// 20160503 - erik - tolta famiglia come chiave nella where 
//  	   --AND a.`art-codfam` = f.`fam-codfam`
$vistaArticoliDelCliente = "
		SELECT a.`art-codart`, 
					 a.`art-descart`, 
           			 a.`art-lungsmu`, 
					 f.`fam-descriz`, 
					 l.`lis-moltipl`, 
					 l.`lis-scarto`, 
					 l.`lis-oneriacc`, 
					 l.`lis-unimis`, 
					 l.`lis-przacq`
		FROM articoli a, famiglie f, clienti c, listino_articoli l
   WHERE c.`cli-codcli` = ?
	   AND l.`lis-codart` = a.`art-codart`
	   AND now() BETWEEN l.`lis-dataini` AND l.`lis-datafin`
";

$vistaVoci = "
		SELECT v.`voc-codvoce`,
           v.`voc-descriz`,
           v.`voc-semanual`,
           f.`codice`,
           f.`formula`,
           f.`critcalc`
      FROM voci_costo v, formule_calcolo f
     WHERE v.`voc-formula` = f.`codice`
       AND v.`voc-codvoce` <> 1
  ORDER BY v.`voc-descriz`
";	

$vistaScontoPerVoce = "
    SELECT `sco-sconto`
      FROM `scontistica_clienti`
     WHERE `sco-codcli` = ?
       AND `sco-codart` = ?
       AND `sco-codvoc` = ?
";

// 20160503 - erik - tolta famiglia come chiave nella where
//  	   --AND a.`art-codfam` = f.`fam-codfam` 
$vistaArticoliPerVoce = "
		SELECT lv.`ivo-przunit`,
           lv.`ivo-flagart`,
           lv.`ivo-flagsmu`,
           lv.`ivo-tiposmu`,
					 a.`art-codart`, 
					 a.`art-descart`, 
					 f.`fam-descriz`, 
					 l.`lis-moltipl`, 
					 l.`lis-scarto`, 
					 l.`lis-oneriacc`, 
					 l.`lis-unimis`, 
					 l.`lis-przacq`					 
      FROM listino_voci lv, articoli a, famiglie f, listino_articoli l
     WHERE lv.`ivo-codvoc` = ?
	     AND lv.`ivo-codart` = a.`art-codart`		 
	     AND l.`lis-codart` = a.`art-codart`
       AND now() BETWEEN lv.`ivo-dataini` AND lv.`ivo-datafin`
";

$vistaCostoPerVoce = "
    SELECT `ivo-przunit` 
      FROM listino_voci 
     WHERE `ivo-codvoc` = ? 
       AND now() BETWEEN `ivo-dataini` AND `ivo-datafin`
";

if (isset($_GET['clienti'])) {
	$result = $mysqli->prepare($vistaClienti);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result(
			$cli_codcli, 
			$cli_ragsoc
	);
	
  $elements = array();
  
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'cli_codcli'  => $cli_codcli,
			'cli_ragsoc'  => $cli_ragsoc
		);
	}
	echo json_encode($elements);
	
	$result->close();
}
else if (isset($_GET['articoliDelCliente'])) {
	$result = $mysqli->prepare($vistaArticoliDelCliente);
	$result->bind_param('s', $_GET['codcli']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result(
			$art_codart, 
			$art_descart, 
      		$art_lungsmu,
			$fam_descriz,
			$lis_moltipl, 
			$lis_scarto, 
			$lis_oneriacc, 
			$lis_unimis, 
			$lis_przacq
	);

  $elements = array();
  
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'art_codart'    => $art_codart, 
			'art_descart'   => $art_descart, 
      		'art_lungsmu'   => $art_lungsmu, 
			'fam_descriz'   => $fam_descriz,
			'lis_moltipl'   => $lis_moltipl, 
			'lis_scarto'    => $lis_scarto, 
			'lis_oneriacc'  => $lis_oneriacc, 
			'lis_unimis'    => $lis_unimis, 
			'lis_przacq'    => $lis_przacq
		);
	}
	echo json_encode($elements);
	
	$result->close();
}
else if (isset($_GET['voci'])) {
	$result = $mysqli->prepare($vistaVoci);
	$result->execute();
	/* bind result variables */
	$result->bind_result(
		  $voc_codvoce,
      $voc_descriz,
      $voc_semanual,
      $codice,
      $formula,
      $critcalc
	);		
  
  $elements = array();
  
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'voc_codvoce'  => $voc_codvoce,
      'voc_descriz'  => $voc_descriz,
      'voc_semanual' => $voc_semanual,
      'codice'       => $codice,
      'formula'      => $formula,
      'critcalc'     => $critcalc
		);
	}

	echo json_encode($elements);
	
	$result->close();
}
else if (isset($_GET['scontoPerVoce'])) {
	$result = $mysqli->prepare($vistaScontoPerVoce);
	$result->bind_param('ssi', 
                      $_GET['codcli'],
                      $_GET['codart'],
                      $_GET['codvoce']);
	$result->execute();

	/* bind result variables */
	$result->bind_result($sconto);
  
  $elements = array();
  
	/* fetch first value */
	while ($result->fetch()) {
		$elements[] = array(
			'sconto'  => $sconto
		);
	}
	echo json_encode($elements);
  
  $result->close();
}
else if (isset($_GET['articoliPerVoce'])) {
	$result = $mysqli->prepare($vistaArticoliPerVoce);
	$result->bind_param('i', $_GET['codvoce']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result(
			$ivo_przunit,
			$ivo_flagart,
			$ivo_flagsmu,
			$ivo_tiposmu,
			$art_codart, 
			$art_descart, 
			$fam_descriz, 
			$lis_moltipl, 
			$lis_scarto, 
			$lis_oneriacc, 
			$lis_unimis, 
			$lis_przacq
	);

  $elements = array();
  
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
	      'ivo_przunit'   => $ivo_przunit,
	      'ivo_flagart'   => $ivo_flagart,
	      'ivo_flagsmu'   => $ivo_flagsmu,
	      'ivo_tiposmu'   => $ivo_tiposmu,
	      'art_codart'    => $art_codart, 
	      'art_descart'   => $art_descart, 
	      'fam_descriz'   => $fam_descriz, 
	      'lis_moltipl'   => $lis_moltipl, 
	      'lis_scarto'    => $lis_scarto, 
	      'lis_oneriacc'  => $lis_oneriacc, 
	      'lis_unimis'    => $lis_unimis, 
	      'lis_przacq'    => $lis_przacq
		);
	}
  
	echo json_encode($elements);
	
	$result->close();
}
else if (isset($_GET['costoPerVoce'])) {
	$result = $mysqli->prepare($vistaCostoPerVoce);
	$result->bind_param('i', $_GET['codvoce']);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result($ivo_przunit);

  $elements = array();
  
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
      'ivo_przunit'   => $ivo_przunit
		);
	}
  
	echo json_encode($elements);
	
	$result->close();
}
else {
	echo json_encode(array('error' => 'nessuna vista'));
}

$mysqli->close();

?>