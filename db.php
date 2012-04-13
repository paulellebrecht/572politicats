<?php
    define("HOSTNAME", "localhost");
    define("DB_NAME", "572cats");
    define("DB_USER", "572cats");
    define("DB_PASS", "53727f39e"); 
    // Attempt connection to database Server
    mysql_connect(HOSTNAME, DB_USER, DB_PASS) or 
        die('ERROR: Fail to connect to database server!');
    // Attempt to access database
    mysql_select_db(DB_NAME) or 
        die("ERROR: Fail to access database");
?>