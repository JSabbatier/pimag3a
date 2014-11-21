<?php
    /**
	@file connect.php
    @brief Connection parameters of the database
    @details This file content the connections parameters. It must be included in all file who need to connect with the database.
    @author Mathias Da Costa
    @code require_once("./connect.php"); @endcode
	 @details Date of modification   :   01/10/2014
*   @date       01/10/2014
*/
 
$hostname = "mysql.imerir.com";
$database = "badmonkey";
$username = "badmonkey";
$password = "x2wP34DEMKC7PxVn";
$dsn = "mysql:host=$hostname;dbname=$database";
 
 
 
?>