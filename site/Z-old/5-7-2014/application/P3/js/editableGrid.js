/**
 *  highlightRow and highlight are used to show a visual feedback. If the row has been successfully modified, it will be highlighted in green. Otherwise, in red
 */
function getURLParameter(name) {//Function to retrieve the value of a GET parameter passed along the URL.
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}


function highlightRow(rowId, bgColor, after)
{
	var rowSelector = $("#" + rowId);
	rowSelector.css("background-color", bgColor);
	rowSelector.fadeTo("normal", 0.5, function() { 
		rowSelector.fadeTo("fast", 1, function() { 
			rowSelector.css("background-color", '');
		});
	});
}
function highlight(div_id, style) {
	highlightRow(div_id, style == "error" ? "#e5afaf" : style == "warning" ? "#ffcc00" : "#8dc70a");
}   
/**
   updateCellValue calls the PHP script that will update the database.  This is a test
 */
function updateCellValue(editableGrid, rowIndex, columnIndex, oldValue, newValue, row, onResponse)
{
	$.ajax({
		url: './getupdate.php',
		type: 'GET',
		dataType: "html",
		data: {
			tablename : editableGrid.name,
			id: editableGrid.getRowId(rowIndex), 
			newvalue: editableGrid.getColumnType(columnIndex) == "boolean" ? (newValue ? 1 : 0) : newValue, 
			colname: editableGrid.getColumnName(columnIndex),
			coltype: editableGrid.getColumnType(columnIndex)			
		},
		success: function (response) 
		{ 
			// reset old value if failed then highlight row
			var success = onResponse ? onResponse(response) : (response == "ok" || !isNaN(parseInt(response))); // by default, a sucessfull reponse can be "ok" or a database id 
			if (!success) editableGrid.setValueAt(rowIndex, columnIndex, oldValue);
		    highlight(row.id, success ? "ok" : "error"); 
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
} 
function DatabaseGridBalanceSheetDebits() 
{ 
	this.editableGrid = new EditableGrid("ubm_model_projected_financial_statement_balance_sheet_debits", {
		enableSort: true,
   	    tableLoaded: function() { datagridbsd.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       	}
 	});
	this.fetchGrid(); 
}
DatabaseGridBalanceSheetDebits.prototype.fetchGrid = function()  {			//Gets information to from php script to fill table.
	// call a PHP script to get the data
	var activeModelUUID = myvar = getURLParameter('activeModelUUID');
	this.editableGrid.loadXML("loadbalancesheetdebitsdata.php?activeModelUUID="+ activeModelUUID);
};
DatabaseGridBalanceSheetDebits.prototype.initializeGrid = function(grid) {	//Renders the grid on the page.
	grid.renderGrid("balancesheetdebits_tablecontent", "testgrid");
};   
function DatabaseGridBalanceSheetCredits() 
{ 
	this.editableGrid = new EditableGrid("ubm_model_projected_financial_statement_balance_sheet_credits", {
		enableSort: true,
   	    tableLoaded: function() { datagridbsc.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       	}
 	});
	this.fetchGrid(); 	
}
DatabaseGridBalanceSheetCredits.prototype.fetchGrid = function()  {			//Gets information to from php script to fill table.
	// call a PHP script to get the data
	var activeModelUUID = myvar = getURLParameter('activeModelUUID');

	this.editableGrid.loadXML("loadbalancesheetcreditsdata.php?activeModelUUID="+ activeModelUUID);
};
DatabaseGridBalanceSheetCredits.prototype.initializeGrid = function(grid) {	//Renders the grid on the page.
	grid.renderGrid("balancesheetcredits_tablecontent", "testgrid");
};  
function DatabaseGridIncomeStatementDebits() 
{ 
	this.editableGrid = new EditableGrid("ubm_model_projected_financial_statement_income_statement_debits", {
		enableSort: true,
   	    tableLoaded: function() { datagridisd.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       	}
 	});
	this.fetchGrid(); 
}
DatabaseGridIncomeStatementDebits.prototype.fetchGrid = function()  {			//Gets information to from php script to fill table.
	// call a PHP script to get the data
	var activeModelUUID = myvar = getURLParameter('activeModelUUID');

	this.editableGrid.loadXML("loadincomestatementdebitsdata.php?activeModelUUID="+ activeModelUUID);
};
DatabaseGridIncomeStatementDebits.prototype.initializeGrid = function(grid) {	//Renders the grid on the page.
	grid.renderGrid("incomestatementdebits_tablecontent", "testgrid");
};   
function DatabaseGridIncomeStatementCredits() 
{ 
	this.editableGrid = new EditableGrid("ubm_model_projected_financial_statement_income_statement_credits", {
		enableSort: true,
   	    tableLoaded: function() { datagridisc.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       	}
 	});
	this.fetchGrid(); 	
}
DatabaseGridIncomeStatementCredits.prototype.fetchGrid = function()  {			//Gets information to from php script to fill table.
	// call a PHP script to get the data
	var activeModelUUID = myvar = getURLParameter('activeModelUUID');
	this.editableGrid.loadXML("loadincomestatementcreditsdata.php?activeModelUUID="+ activeModelUUID);
};
DatabaseGridIncomeStatementCredits.prototype.initializeGrid = function(grid) {	//Renders the grid on the page.
	grid.renderGrid("incomestatementcredits_tablecontent", "testgrid");
};