<?php
require_once __DIR__ . '/db_config.php';
function export_excel_csv() {
	$conn = mysql_connect ( DB_SERVER, DB_USER, DB_PASSWORD ) or die ( 'Cannot connect to the DB' );
	$db = mysql_select_db ( DB_DATABASE, $conn ) or die ( 'Cannot select the DB' );
	
	
	$output = "";
	$sql = "SELECT * FROM TestTable";
	$rec = mysql_query ( $sql ) or die ( mysql_error () );
	$columns_total = mysql_num_fields($rec);
	
	// Get The Field Name
	
	for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($rec, $i);
		$output .= '"'.$heading.'",';
	}
	$output .="\n";
	
	// Get Records from the table
	
	while ($row = mysql_fetch_array($rec)) {
		for ($i = 0; $i < $columns_total; $i++) {
			$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
	}
	
	// Download the file
	
	$filename = "db.csv";
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	
	print $output;
}

export_excel_csv ();

?>