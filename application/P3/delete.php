<?php
 
/*
 * examples/mysql/loaddata.php
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
      
require_once('config.php');         

// Database connection                                   
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// Get all parameters provided by the javascript
$key = $conn->real_escape_string(strip_tags($_GET['key']));
$id = $conn->real_escape_string(strip_tags($_GET['id']));
$tablename = $conn->real_escape_string(strip_tags($_GET['tablename']));      
if($key=="YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD"){
     $sqldel = "DELETE
                FROM ".$tablename." 
                WHERE id=".$id.";";
    if ($conn->query($sqldel) === false) {
        trigger_error('Wrong SQL: ' . $sqldel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $deleted_rows = $conn->affected_rows;
        echo $_GET['callback'] . '(' . "{'message' : 'Requested action deleted: $deleted_rows rows from $tablename .'}" . ')';
    }		
}else{
        echo $_GET['callback'] . '(' . "{'message' : 'Requested action cannot be completed.'}" . ')';
}

                              
			
				