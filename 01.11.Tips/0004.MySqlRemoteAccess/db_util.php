<?php

function datetime_get(){
    date_default_timezone_set("America/Santiago");
	$szDt = date("Y-m-d H:i:s");
	$szDt = str_replace(" ", "_", $szDt);
	$szDt = str_replace(":", "", $szDt);

    return $szDt;
}

function order_id_get() {
    
    $uniqueId = uniqid();

    $orderString = "ORDER" . "-" . strtoupper($uniqueId);

    printf("***\n");
    printf("uniqueID = [%s]\n", $uniqueId );
    printf("***\n");

    return $orderString;
}

/* --------------------------------------------- */
function db_connect(){
/*
 * Inicia una conecion a la base de datos
 * Return a connector for using in other db functions as
 * insert or update.
 * ----------------------------------------------------- */

            /* @1: Aqui se ponen los parametros de conexion */
            $servername = **********; //"beelzebot.com"; //"34.174.168.65";
            $username 	= **********;
            $password 	= **********;
            $dbname 	= **********;
            /* @1:END */

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {

                $szLine = sprintf("DB Connect failed: %s", $conn->connect_error );
                log_error( $szLine );

            }else{

                $szLine = sprintf("DB %s at %s Connected", $dbname, $servername );
                log_activity( $szLine );

            }

            return $conn;
}

/* --------------------------------------------- */
function db_close($conn){
/*
 * Cierra la conecion a la base de datos 
 * Uso interno en sql_db
 * ---------------------------------------------*/
    $conn->close();
            //sys_log_add("db_closed", "DB Closed", $conn->connect_error, "-");
}

function db_table_insert_array ($szTableName, $aszCols, $aszValues){

	if(sizeof($aszCols) != sizeof($aszValues) ){
		log_activity( sprintf( "table_insert_array 01: ERROR: Nro cols =%s, Nro values = %s",
						sizeof($aszCols), sizeof($aszValues) ) );
		$backtrace = debug_backtrace();
		log_activity( sprintf("table_insert_array 01: Please check:<br>line %s<br>file: %s<br>current function: %s<br>",
								$backtrace[0]['line'], basename($backtrace[0]['file']), $backtrace[0]['function'] ) );

		$AA = sizeof($aszCols);
		$BB = sizeof($aszValues);
		if( $AA < $BB )
			$countAA = $BB;
		if( $BB < $AA )
			$countAA = $AA;

		for( $countAA=0; $countAA < $BB ; $countAA++ ){
			log_activity( sprintf( "table_insert_array 02: [%s]: [%s] = [%s]<br>" , 
										$countAA, $aszCols[$countAA], $aszValues[$countAA] )  );
		}
		exit(0);
	}

	$sql =  sprintf("INSERT INTO %s ( ", $szTableName);

	$nNumCols = sizeof($aszCols);

	/*@1: add columns to qry */
	for( $i = 0, $nNumCols = sizeof($aszCols) ; $i < $nNumCols - 1; $i++ ){
		$sql = $sql . sprintf("%s,", $aszCols[$i]);
	}
	$sql = $sql . sprintf("%s", $aszCols[$i]);
	/*@1: END */

	/*@1: add values to qry */
	$sql = $sql . sprintf(") VALUES ( ");
	for( $i = 0, $nNumCols = sizeof($aszCols) ; $i < $nNumCols-1; $i++ ){
		$sql = $sql . sprintf("'%s',", $aszValues[$i]);
	}
	$sql = $sql . sprintf("'%s' );", $aszValues[$i]);
	/*@1: END */

	//echo "<br>" . $sql . "<br>";

	log_activity( sprintf( "table_insert_array 03: %s<br>", $sql ) );

	$conn = db_connect();
	if ($conn->query($sql) == TRUE ){
		$last_id = $conn->insert_id;
	}else {
		$szErrorMsg = $conn->error;
		log_activity(sprintf("table_insert_array 05: ERROR %s",$szErrorMsg));
		$last_id = null;
	}

	db_close($conn);
	return $last_id;
}

function log_activity( $szLine ){
    if( isset( $_SERVER['REMOTE_ADDR'] ) ){
        /**
         * This case, this script is running as server.
         */
        $clientIP = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }else{
        /**
         * This case, this script is running as client AND
         * the script was runned in a terminal: $php insert_record.php
         */
        $ip = shell_exec('hostname -I');
        $ip = explode(' ', trim($ip))[0]; // En caso de que haya múltiples IPs, tomar la primera
        //echo "Local IP Address: " . $ip . "\n";
        $clientIP = $ip;

    }

    date_default_timezone_set('America/Santiago');
    
    $timeStamp = date('Y-m-d H:i:s');
    $logEntry = $timeStamp . " - ";

    $logEntry .= $clientIP . " - ";

    $logEntry .= htmlspecialchars($szLine);

    // Add a new line at the end of each entry
    $logEntry .= PHP_EOL;

    $file = fopen("./log/activity.log", "a");
    fwrite($file, $logEntry);
    fclose($file);

    printf("ACT: %s", $logEntry );

}

function log_error( $szLine ){
    $clientIP = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    date_default_timezone_set('America/Santiago');
    
    $timeStamp = date('Y-m-d H:i:s');
    $logEntry = $timeStamp . " - ";

    $logEntry .= $clientIP . " - ";

    $logEntry .= htmlspecialchars($szLine);

    // Add a new line at the end of each entry
    $logEntry .= PHP_EOL;

    $file = fopen("./log/activity.log", "a");
    fwrite($file, $logEntry);
    fclose($file);

    printf("<p>ERR: %s</p>", $logEntry );
}

?>