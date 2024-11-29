<?php
include 'db_util.php';

main();
exit(0);

/* -------------------------------------------- */
function main(){
/* 
 * Main code here!!!
 * -------------------------------------------- */

    $conn = db_connect();
    add_order();
    db_close( $conn );

}

/**
 * 
 */
function add_order(){
	$szTableName 		= 	"orders";

    $arrayColsNames [0]	=	"order_id";	 
	$arrayColsValues[0]	=   order_id_get();

    $arrayColsNames [1]	=	"order_type";	 
	$arrayColsValues[1]	=   "USD";

    $arrayColsNames [2]	=	"order_datetime";	 
	$arrayColsValues[2]	=   datetime_get();

    db_table_insert_array ( $szTableName, $arrayColsNames, $arrayColsValues );
}



?>