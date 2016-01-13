<html>
<head>
</head>
<body>
<?php
error_reporting(E_ALL);
include_once 'phpgen_settings.php';
$conn = GetGlobalConnectionOptions();
$database = $conn['database'];
$username = $conn['username'];
$password = $conn['password'];
$db = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", "$username", "$password");

/*
 Connect to the local server using Windows Authentication and specify
the AdventureWorks database as the database in use. To connect using
SQL Server Authentication, set values for the "UID" and "PWD"
attributes in the $connectionInfo parameter. For example:
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"AdventureWorks");
*/
$serverName = "ASUS-ERIK\SQLSERVER2008R2";
$uid = 'atig';
$pwd = 'atig';
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "Database"=>"ATIG_EXPORT");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn )
{
	//echo "Connection established.\n";
	$sql = "select ANCODICE,ANDESCRI,ANINDIR2 FROM [ATIG_EXPORT].[dbo].[ATIGCONTI] where ANTIPCON = 'C'";
	$stmt = sqlsrv_query( $conn, $sql );
	$query = '';
	$count = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		
		$query .= "INSERT INTO `atig`.`clienti`
					(
					`cli-codcli`,
					`cli-ragsoc`,
					`cli-codlis`,
					`datains`,
					`datamod`)
					VALUES
					(
					" .  $row['ANCODICE'] . " , '" . addslashes(rtrim($row['ANDESCRI'])) ." " . addslashes(ltrim($row['ANINDIR2'])) . "',
					'',
					CURRENT_TIMESTAMP,
					CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE 
      datamod = CURRENT_TIMESTAMP,`cli-ragsoc` = '" . addslashes(rtrim($row['ANDESCRI'])) ." " . addslashes(ltrim($row['ANINDIR2'])) . "'; ";
		$count++;
	}
	
	sqlsrv_free_stmt( $stmt);
	//echo $query;
	$db->query($query);
	echo "<h2>Importati tutti i Clienti (" . $count . ")</h2>";
	
	$sql = "select ARCODART,ARDESART,ARCODFAM FROM [ATIG_EXPORT].[dbo].[ATIGART_ICOL] where ARCODFAM is not null";
	$stmt = sqlsrv_query( $conn, $sql );
	$query = '';
	$count = 0;
	$cc = 0;
	
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	
		$query .= "INSERT IGNORE INTO `atig`.`articoli`
					(
					`art-codart`,
					`art-descart`,
					`art-codfam`,
					`datains`,
					`datamod`)
					VALUES
					(
					'" .  $row['ARCODART'] . "' , 
				    '" . addslashes(rtrim($row['ARDESART'])) ."',
				    '" .  $row['ARCODFAM'] . "' ,
					CURRENT_TIMESTAMP,
					CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE
      				datamod = CURRENT_TIMESTAMP,`art-descart` = '" . addslashes(rtrim($row['ARDESART'])) . "'; ";
		$count++;
	}
	
	sqlsrv_free_stmt( $stmt);
	//echo $query;
	$db->query($query);
	echo "<h2>Importati tutti gli articoli (" . $count . ")</h2>";
	
	
	$sql = "select FACODICE,FADESCRI FROM [ATIG_EXPORT].[dbo].[ATIGFAM_ARTI]";
	$stmt = sqlsrv_query( $conn, $sql );
	$query = '';
	$count = 0;
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	
		$query .= "INSERT INTO `atig`.`famiglie`
					(
					`fam-codfam`,
					`fam-descriz`,
					`datains`,
					`datamod`)
					VALUES
					(
					'" .  $row['FACODICE'] . "' , '" . addslashes(rtrim($row['FADESCRI'])) ."',
					CURRENT_TIMESTAMP,
					CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE
      				datamod = CURRENT_TIMESTAMP,`fam-descriz` = '" . addslashes(rtrim($row['FADESCRI'])) . "'; ";
		$count++;
	}
	
	sqlsrv_free_stmt( $stmt);
	//echo $query;
	$db->query($query);
	echo "<h2>Importati tutte le famiglie (" . $count . ")</h2>";
}
else
{
	echo "Connection could not be established.\n";
	die( print_r( sqlsrv_errors(), true));
}

//-----------------------------------------------
// Perform operations with connection.
//-----------------------------------------------

/* Close the connection. */
sqlsrv_close( $conn);
?>
<script type="text/javascript">

</script>
</body>
</html>