@extends('layout.main')
@section('header')
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="http://www.universalbusinessmodel.com/examples/css/05.css">
@stop
@section('content')
	@if(Auth::check())
	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-sm-3 col-md-2 sidebar">
	          <ul class="nav nav-sidebar">
	            <li class="active"><a href="#">Overview</a></li>
	            <li><a href="#">Automated Model Creation</a></li>
	            <li><a href="#">Automated Product Creation</a></li>
	            <li><a href="#">Automated App Creation</a></li>
	            <li><a href="#">UBM App Store</a></li>
	          </ul>
	          <ul class="nav nav-sidebar">
	            <li><a href="">Professional Services</a></li>
	            <li><a href="">Developer Kit</a></li>
	            <li><a href="">Management Reporting</a></li>
	            <li><a href="">Strategic Command Centers</a></li>
	          </ul>
	        </div>
	        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	          <h1 class="page-header">Management Reporting - Table of Contents</h1>
	          <a href=""><h2 class="sub-header">(A) Model Creation</h2></a>
				<div class="toggles">
					<a id="loadGraph" href="#" class="ui-btn">Load Graph</a>
				</div>
				<div id="3d_graph_wrapper" onload="modifyTableValues()">
					<div class="chart">
						<h2>Model Creation Suite Progress for: [Legal Entity Name Here]</h2>
						<table id="data-table" border="1" cellpadding="10" cellspacing="0" summary="Monkeys">
							<caption>Steps Completed</caption>
							<thead>
								<tr>
									<td>&nbsp;</td>
									<th scope="col">Setup</th>
									<th scope="col">Control</th>
									<th scope="col">Phase 1</th>
									<th scope="col">Phase 2</th>
									<th scope="col">Phase 3</th>
									<th scope="col">Phase 4</th>
									<th scope="col">Phase 5</th>
									<th scope="col">Phase 6</th>
									<th scope="col">Phase 7</th>
									<th scope="col">Phase 8</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">Prepared By</th>
									<td>8</td>
									<td>7</td>
									<td>6</td>
									<td>5</td>
									<td>4</td>
									<td>3</td>
									<td>2</td>
									<td>1</td>
									<td>10</td>
									<td>10</td>
								</tr>
								<tr>
									<th scope="row">Reviewed By</th>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
									<td>8</td>
									<td>10</td>
									<td>10</td>
								</tr>
								<tr>
									<th scope="row">Final Review</th>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>4</td>
									<td>10</td>
									<td>10</td>
								</tr>
							</tbody>
						</table>
					</div>
				Use arrows to rotate the graph.

				</div>
				<br /><br /><br /><br /><br /><br />
	          <div id="burt_container">
	          	<p>A detailed burt report showing prepared by, reviewed by, final reviewed by will soon show up below.<br />Special Thanks to Standard Restaurant Supply </p>
	          </div>
	          </div>
	        </div>
	      </div>
	    </div>
	@else
		<center><p>You must be signed in to view this resource.</p></center>
	@endif
@stop
@section('javascript')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
		<!-- JavaScript at the bottom for fast page loading -->
		
	@if(Auth::check())		
		<!-- Example JavaScript -->
		<script src="http://www.universalbusinessmodel.com/examples/js/05.js"></script>
		
	
		<!-- Example JavaScript -->
	    <script>
		$( "#burt_container" ).hover(function() {
	    	$('iframe').remove();
			$('<iframe />', {height: 500,width: 800,src:  'http://www.universalbusinessmodel.com'}).appendTo('#burt_container');
		});
		$( "#3d_graph_wrapper" ).hover(function() {
			modifyTableValues();
		});
		function modifyTableValues(){
			//alert("this is a test");
			//Prepared By Table Cell Variables
			var PB_Setup = $('#data-table tr:eq(1) td:eq(0)');
			var PB_Control = $('#data-table tr:eq(1) td:eq(1)');
			var PB_P1 = $('#data-table tr:eq(1) td:eq(2)');
			var PB_P2 = $('#data-table tr:eq(1) td:eq(3)');
			var PB_P3 = $('#data-table tr:eq(1) td:eq(4)');
			var PB_P4 = $('#data-table tr:eq(1) td:eq(5)');
			var PB_P5 = $('#data-table tr:eq(1) td:eq(6)');
			var PB_P6 = $('#data-table tr:eq(1) td:eq(7)');
			var PB_P7 = $('#data-table tr:eq(1) td:eq(8)');
			var PB_P8 = $('#data-table tr:eq(1) td:eq(9)');
			//Reviewed By Table Cell Variables
			var RB_Setup = $('#data-table tr:eq(2) td:eq(0)');
			var RB_Control = $('#data-table tr:eq(2) td:eq(1)');
			var RB_P1 = $('#data-table tr:eq(2) td:eq(2)');
			var RB_P2 = $('#data-table tr:eq(2) td:eq(3)');
			var RB_P3 = $('#data-table tr:eq(2) td:eq(4)');
			var RB_P4 = $('#data-table tr:eq(2) td:eq(5)');
			var RB_P5 = $('#data-table tr:eq(2) td:eq(6)');
			var RB_P6 = $('#data-table tr:eq(2) td:eq(7)');
			var RB_P7 = $('#data-table tr:eq(2) td:eq(8)');
			var RB_P8 = $('#data-table tr:eq(2) td:eq(9)');
			//Final Reviewed By Table Cell Variables
			var FRB_Setup = $('#data-table tr:eq(3) td:eq(0)');
			var FRB_Control = $('#data-table tr:eq(3) td:eq(1)');
			var FRB_P1 = $('#data-table tr:eq(3) td:eq(2)');
			var FRB_P2 = $('#data-table tr:eq(3) td:eq(3)');
			var FRB_P3 = $('#data-table tr:eq(3) td:eq(4)');
			var FRB_P4 = $('#data-table tr:eq(3) td:eq(5)');
			var FRB_P5 = $('#data-table tr:eq(3) td:eq(6)');
			var FRB_P6 = $('#data-table tr:eq(3) td:eq(7)');
			var FRB_P7 = $('#data-table tr:eq(3) td:eq(8)');
			var FRB_P8 = $('#data-table tr:eq(3) td:eq(9)');
			//secondToLastCell.html("123456789");
			$.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_get_checklistitems_for_graph.php?callback=?', {//JSONP Request to Open Items Page setup tables
				activeModelId : 1
			}, function(res, status) {
				var sectionCounter=0;
				$.each(res, function(i, item) {
					if(sectionCounter==0){
						 PB_Setup.html(item.MFIS_count);
						 PB_Control.html(item.CS_count);
						 PB_P1.html(item.P1_count);
						 PB_P2.html(item.P2_count);
						 PB_P3.html(item.P3_count);
						 PB_P4.html(item.P4_count);
						 PB_P5.html(item.P5_count);
						 PB_P6.html(item.P6_count);
						 PB_P7.html(item.P7_count);
						 PB_P8.html(item.P8_count);
					}else{
						if(sectionCounter==1){
							 RB_Setup.html(item.MFIS_count);
							 RB_Control.html(item.CS_count);
							 RB_P1.html(item.P1_count);
							 RB_P2.html(item.P2_count);
							 RB_P3.html(item.P3_count);
							 RB_P4.html(item.P4_count);
							 RB_P5.html(item.P5_count);
							 RB_P6.html(item.P6_count);
							 RB_P7.html(item.P7_count);
							 RB_P8.html(item.P8_count);
						}else{
							if(sectionCounter==2){
								 FRB_Setup.html(item.MFIS_count);
								 FRB_Control.html(item.CS_count);
								 FRB_P1.html(item.P1_count);
								 FRB_P2.html(item.P2_count);
								 FRB_P3.html(item.P3_count);
								 FRB_P4.html(item.P4_count);
								 FRB_P5.html(item.P5_count);
								 FRB_P6.html(item.P6_count);
								 FRB_P7.html(item.P7_count);
								 FRB_P8.html(item.P8_count);
							}else{
								
							}
						}
					}
						//alert("This is the counter: "+sectionCounter);
				
					sectionCounter++;
				});
			});
		}
	</script>
	@else
	
	@endif
@stop