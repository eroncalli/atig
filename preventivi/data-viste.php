<?php
/**
 * Viste sul DB
 **/

//- Turn off all error reporting
// error_reporting(0);

include ('connect.php');

$mysqli = new mysqli($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
	echo json_encode(array('error' => 'connection'));
	exit();
}

$vistaClienti = "
		SELECT `cli-codcli`, `cli-ragsoc` FROM clienti
";

$vistaArticoliDelCliente = "
		SELECT a.`art-codart`, 
					 a.`art-descart`, 
					 f.`fam-descriz`, 
					 a.`art-spessore`, 
					 l.`lis-moltipl`, 
					 l.`lis-scarto`, 
					 l.`lis-oneriacc`, 
					 l.`lis-unimis`, 
					 l.`lis-przacq`
		FROM articoli a, famiglie f, clienti c, listino_articoli l
   WHERE c.`cli-codcli` = ?
	   AND c.`cli-codlis` = l.`lis-codlis`
	   AND l.`lis-codart` = a.`art-codart`
	   AND a.`art-codfam` = f.`fam-codfam`
	   AND now() BETWEEN l.`lis-dataini` AND l.`lis-datafin`
";

$vistaVoci = "
		SELECT v.`voc-codvoce`,
           v.`voc-descriz`,
           v.`voc-semanual`,
           v.`voc-critcalc`,
           f.`codice`,
           f.`formula`
      FROM voci_costo v, formule_calcolo f
     WHERE v.`voc-formula` = f.`codice`
";	

$vistaArticoliPerVoce = "
		SELECT lv.`ivo-przunit`,
           lv.`ivo-flagart`,
           lv.`ivo-flagsmu`,
           lv.`ivo-tiposmu`,
					 a.`art-codart`, 
					 a.`art-descart`, 
					 f.`fam-descriz`, 
					 a.`art-spessore`, 
					 l.`lis-moltipl`, 
					 l.`lis-scarto`, 
					 l.`lis-oneriacc`, 
					 l.`lis-unimis`, 
					 l.`lis-przacq`					 
      FROM listino_voci lv, articoli a, famiglie f, listino_articoli l
     WHERE lv.`ivo-codvoc` = ?
	     AND lv.`ivo-codart` = a.`art-codart`		 
	     AND l.`lis-codart` = a.`art-codart`
	     AND a.`art-codfam` = f.`fam-codfam` 
       AND now() BETWEEN lv.`ivo-dataini` AND lv.`ivo-datafin`
";

if (isset($_GET['clienti'])) {
	$result = $mysqli->prepare($vistaClienti);
	$result->execute();
	
	/* bind result variables */
	$result->bind_result(
			$cli_codcli, 
			$cli_ragsoc
	);
	
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
			$fam_descriz,
			$art_spessore, 
			$lis_moltipl, 
			$lis_scarto, 
			$lis_oneriacc, 
			$lis_unimis, 
			$lis_przacq
	);
				
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'art_codart'    => $art_codart, 
			'art_descart'   => $art_descart, 
			'fam_descriz'   => $fam_descriz,
			'art_spessore'  => $art_spessore, 
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
      $voc_critcalc,
      $codice,
      $formula
	);		
	/* fetch values */
	while ($result->fetch()) {
		$elements[] = array(
			'voc_codvoce'    => $voc_codvoce,
      'voc_descriz'    => $voc_descriz,
      'voc_semanual'    => $voc_semanual,
      'voc_critcalc'    => $voc_critcalc,
      'codice'    => $codice,
      'formula'    => $formula
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
			$art_spessore, 
			$lis_moltipl, 
			$lis_scarto, 
			$lis_oneriacc, 
			$lis_unimis, 
			$lis_przacq
	);
				
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
      'art_spessore'  => $art_spessore, 
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
else {
	echo json_encode(array('error' => 'nessuna vista'));
}

$mysqli->close();

?>