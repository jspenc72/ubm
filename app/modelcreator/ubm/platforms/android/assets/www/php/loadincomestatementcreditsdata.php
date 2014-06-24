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
                              


/**
 * This script loads data from the database and returns it to the js
 *
 */
       
require_once('config.php');      
require_once('EditableGrid.php');            
$activeRowId = 10;

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli,$query){
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}


// Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
$grid->addColumn('id', 'Line #', 'integer', NULL, false); 
$grid->addColumn('account_number', 'Acct #', 'string');  
$grid->addColumn('description', 'Description', 'string');  
$grid->addColumn('year_2014', '2014', 'float');  
$grid->addColumn('year_2015', '2015', 'float'); 
$grid->addColumn('year_2016', '2016', 'float');  
$grid->addColumn('year_2017', '2017', 'float');  
$grid->addColumn('year_2018', '2018', 'float');  
$grid->addColumn('year_2019', '2019', 'float');  
$grid->addColumn('year_2020', '2020', 'float');  
$grid->addColumn('year_2021', '2021', 'float');  
$grid->addColumn('year_2022', '2022', 'float');  
$grid->addColumn('year_2023', '2023', 'float');  
$grid->addColumn('year_2024', '2024', 'float');  
$grid->addColumn('account_total', 'Total', 'float');  
 
/* The column id_country and id_continent will show a list of all available countries and continents. So, we select all rows from the tables */
/*** /
$grid->addColumn('id_continent', 'Continent', 'string' , fetch_pairs($mysqli,'SELECT id, name FROM continent'),true);  
$grid->addColumn('id_country', 'Country', 'string', fetch_pairs($mysqli,'SELECT id, name FROM country'),true );  
$grid->addColumn('email', 'Email', 'email');                                               
$grid->addColumn('freelance', 'Freelance', 'boolean');  
$grid->addColumn('lastvisit', 'Lastvisit', 'date');  
$grid->addColumn('website', 'Website', 'string');  /***/
                                                                       
/*
 * $result is the results of selecting all rows from the table of interest.
 * The table name must match the name of the EditableGrid on line 50 of the demo.js file, if is doesnt, the table will not update the database values and it will appear red instead of greed when you try to edit the table.
 * 
 * "excerpt from line 50 of demo.js: 		NOTE demo1 is the name given to EditableGrid
 * 
 * this.editableGrid = new EditableGrid("demo1", { ..... }
 * 
 */
$result = $mysqli->query('SELECT * FROM projected_financial_statement_income_statement_credits WHERE model_id="1" ORDER BY account_number LIMIT 100');
$mysqli->close();

// send data to the browser
$grid->renderXML($result);

