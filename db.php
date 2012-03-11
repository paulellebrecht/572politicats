<?php
    define("HOSTNAME", "localhost");
    define("DB_NAME", "politicats");
    define("DB_USER", "quiz");
    define("DB_PASS", "password"); 
    // Attempt connection to database Server
    mysql_connect(HOSTNAME, DB_USER, DB_PASS) or 
        die('ERROR: Fail to connect to database server!');
    // Attempt to access database
    mysql_select_db(DB_NAME) or 
        die("ERROR: Fail to access database");
?>