<?php
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	if (isset ( $_POST ['table'] )) {
		
		require_once __DIR__ . '/db_config.php';
		
		$conn = mysql_connect ( DB_SERVER, DB_USER, DB_PASSWORD ) or die ( 'Cannot connect to the DB' );
		$db = mysql_select_db ( DB_DATABASE, $conn ) or die ( 'Cannot select the DB' );
		
		require 'exportcsv.inc.php';
		
		$query = "Select * from " . htmlspecialchars ( $_POST ["table"] ); // this is the tablename that you want to export to csv from mysql.
		
		exportMysqlToCsv ( $query );
	}
}
?>