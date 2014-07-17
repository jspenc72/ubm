/**
 *  highlightRow and highlight are used to show a visual feedback. If the row has been successfully modified, it will be highlighted in green. Otherwise, in red
 */
function getURLParameter(name) {//Function to retrieve the value of a GET parameter passed along the URL.
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}

function deleteRecord(row,record,tableName){
	// alert(row);
	// alert(record);
		$.getJSON('delete.php?callback=?', {//JSONP Request
			key: "YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD",
			tablename: tableName,
			id: record
		}, function(res, status) {
					$("#ubmsuite_mcs_my_organizational_chart_heirarchyObjectTree_ul_ST_" + window.activeStepId + "").empty();
			$.each(res, function(i, item) {
					//3. Append all children to their respective "reports_to" ul
					$("#ubmsuite_mcs_my_organizational_chart_heirarchyObjectTree_ul_ST_" + window.activeStepId + "").append("<li><a  onclick='setActiveTaskId(" + item.id + ")'>TK-" + item.id + "</a><ul id='ubmsuite_mcs_my_organizational_chart_heirarchyObjectTree_ul_TK_" + item.id + "'></ul></li>");
					//4. Empty chart Div
			        $('#chart').empty();
					//5. Call jOrgChart plugin, append new org chart to chart div, set jorgdraganddrop to false to avoid conflicting compatibility issue with other jquery packages.
			        $("#modelOrgChart").jOrgChart({
			            chartElement : '#chart',
			            dragAndDrop  : false
			        }); /***/
			});
		});		
	
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
   	    tableLoaded: function() { 
		//Set Custom Cell Renderer for the Delete Button
		 	this.setCellRenderer('action', new CellRenderer({
				render : function(cell, value) {
					cell.innerHTML = "<a class='deleteThisRow'><img src='img/file_delete.png' title='Delete Record' alt='Delete Record' height='42' width='42'></a>";
					
					$( ".deleteThisRow" ).click(function() {
						var idOfThisRow = "ubm_model_projected_financial_statement_balance_sheet_debits_" + $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisRecord = $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisTable = "ubm_model_projected_financial_statement_balance_sheet_debits";
						$("[id*="+idOfThisRow+"]").css('display', 'none');  
						deleteRecord(idOfThisRow, idOfThisRecord, idOfThisTable);
					});						
			}}));   	    	
   	    	datagridbsd.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       },
       
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
   	    tableLoaded: function() { 
			//Set Custom Cell Renderer for the Delete Button
			 	this.setCellRenderer('action', new CellRenderer({
					render : function(cell, value) {
					cell.innerHTML = "<a class='deleteThisRow'><img src='img/file_delete.png' title='Delete Record' title='Delete Record' alt='Delete Record' height='42' width='42'></a>";
						$( ".deleteThisRow" ).click(function() {
						var idOfThisRow = "ubm_model_projected_financial_statement_balance_sheet_credits_" + $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisRecord = $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisTable = "ubm_model_projected_financial_statement_balance_sheet_credits";
						$("[id*="+idOfThisRow+"]").css('display', 'none');  
						deleteRecord(idOfThisRow, idOfThisRecord, idOfThisTable);
						});						
				}}));  	
	   	    	datagridbsc.initializeGrid(this);
   	    	},
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
   	    tableLoaded: function() { 
		//Set Custom Cell Renderer for the Delete Button
		 	this.setCellRenderer('action', new CellRenderer({
				render : function(cell, value) {
					cell.innerHTML = "<a class='deleteThisRow'><img src='img/file_delete.png' title='Delete Record' alt='Delete Record' height='42' width='42'></a>";
					$( ".deleteThisRow" ).click(function() {
						var idOfThisRow = "ubm_model_projected_financial_statement_income_statement_debits_" + $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisRecord = $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisTable = "ubm_model_projected_financial_statement_income_statement_debits";
						$("[id*="+idOfThisRow+"]").css('display', 'none');  
						
						deleteRecord(idOfThisRow, idOfThisRecord, idOfThisTable);
					});						
			}}));   	    	
   	    	datagridisd.initializeGrid(this); },
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
   	    tableLoaded: function() { 
		//Set Custom Cell Renderer for the Delete Button
		 	this.setCellRenderer('action', new CellRenderer({
				render : function(cell, value) {
					cell.innerHTML = "<a class='deleteThisRow'><img src='img/file_delete.png' title='Delete Record' alt='Delete Record' height='42' width='42'></a>";
					$( ".deleteThisRow" ).click(function() {
						var idOfThisRow = "ubm_model_projected_financial_statement_income_statement_credits_" + $(this).parentsUntil("tbody").find( ".number" ).html();
						var idOfThisRecord = $(this).parentsUntil("tbody").find( ".number" ).html();
						var indexOfThisRow = cell.rowIndex;
						var idOfThisTable = "ubm_model_projected_financial_statement_balance_sheet_debits";
						$("[id*="+idOfThisRow+"]").css('display', 'none');  
						deleteRecord(idOfThisRow, idOfThisRecord, idOfThisTable);
					});						
			}}));   	    	
   	    	datagridisc.initializeGrid(this); },
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
function removeRow(){
	editableGrid.remove(" + cell.rowIndex + "); 	
}
