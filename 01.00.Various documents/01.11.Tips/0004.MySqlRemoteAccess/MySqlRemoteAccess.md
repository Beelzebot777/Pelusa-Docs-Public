# SiteGround MySQL Remote Access
1. Database
 
    |DB Name|DB Label|DB User|
    |----|----|----|
    ||**********||db_test||**********||

1. User
 
    |USR Name     |USR Label|User Password|Access|
    |-------------|---------|-------------|----|
    |**********|usr_test ||**********|     |ALL |

1. Remote Access
 
    |Host        |Host Label|
    |------------|----------|
    |186.105.56.5|Casa Stgo.|

1.  Table
    ```
    CREATE TABLE `dbkncasmprr5tv`.`orders` ( 
          `auto_ndx` INT UNSIGNED NOT NULL AUTO_INCREMENT 
        , `order_id` VARCHAR(20) NOT NULL DEFAULT '-' 
        , `order_type` VARCHAR(10) NOT NULL DEFAULT '-'

        , `order_datetime` VARCHAR(20) NOT NULL DEFAULT '-' , PRIMARY KEY (`auto_ndx`)) ENGINE = InnoDB; 
    ```
3. Main PHP Script
    - Here only code for implementing the funcionality.
    - All the access to the DB has been in a separate library, this case, db_util.php
    - Samething with utility functions as datetime_get or other functions, these ones must be in other library, name others_util.php
        ```
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
                $szTableName 		=   "orders";

                $arrayColsNames [0]	=   "order_id";	 
                $arrayColsValues[0]	=   order_id_get();

                $arrayColsNames [1]	=   "order_type";	 
                $arrayColsValues[1]	=   "USD";

                $arrayColsNames [2]	=   "order_datetime";	 
                $arrayColsValues[2]	=   datetime_get();

                db_table_insert_array ( $szTableName, $arrayColsNames, $arrayColsValues );
            }
            ?>
        ```
1. DB util PHP Script

    - Here all the functions for accessing de DB.
