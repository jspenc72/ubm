<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--
-->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Projected Financial Statement</title>
		<link rel="stylesheet" href="../../css/editableGrid.css" type="text/css" media="screen">
	</head>
	<body>
		<div id="editableGripwrap">
			<h1>Editable Financial Statement Demo - With MySQL Database Link</h1> 
			<h2>Balance Sheet - Debits (Assets 100-199)</h2> 
				<!-- Feedback message zone -->
				<div id="message"></div>
				<!-- Grid contents -->
				<div id="balancesheetdebits_tablecontent"></div>				<!-- Balace Sheet Debits-->
				<!-- Paginator control -->
				<div id="paginator"></div>
			<h2>Balance Sheet - Credits (Liabilities 200-299 + Owners Equity 300-399)</h2> 
			<p>Balance Sheet - Credits (Liabilities + Stock + Retained Earnings)</p> 
				<!-- Grid contents -->
				<div id="balancesheetcredits_tablecontent"></div>				<!-- Balace Sheet Credits-->
			<h2>Income Statement - Debits (Expenses 500-799)</h2> 
				<div id="incomestatementdebits_tablecontent"></div>				<!-- Income Statement Credits-->
			<h2>Income Statement - Credits (Income 400-499)</h2> 
				<div id="incomestatementcredits_tablecontent"></div>			<!-- Income Statement Debits-->
		</div>  
		<!-- -->
		<script src="../../js/editablegrid-2.0.1.js"></script>   
		<script src="../../js/editableGrid.js" ></script>
		<!-- I use jQuery for the Ajax methods This is a test-->
		<script src="../../js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript">
			window.onload = function() { 
				datagridbsd = new DatabaseGridBalanceSheetDebits();
				datagridbsc = new DatabaseGridBalanceSheetCredits();
				datagridisd = new DatabaseGridIncomeStatementDebits();
				datagridisc = new DatabaseGridIncomeStatementCredits();
			}; 
		</script>
	</body>

</html>
