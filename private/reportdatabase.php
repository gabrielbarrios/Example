<script language="JavaScript" src ="../js/bottomindexdatabase.js"> </script>
<link rel="stylesheet" href="../css/general.css" />
<?php
	include_once("../header/private.php");
	
	echo("<a href='../private/'>HOME</a><br>");
	echo ("<br>");
	echo "
	<input type='hidden' id='valuemax' value='$valuemax'/>
	<input type='hidden' id='start' value='1'/>
	<div class='search' style='display:block'>
				<div>
				Search:<input type='text' placeholder='First name, Last name..' onKeyUp='setTimeout(function() {searchreport(this);},500);' value='' id='search'>
				
				</div>
				Only with email <input type='checkbox' id='email' value='' style='' onclick='searchreport(this);'><br>
				Only with mobile phone<input type='checkbox' id='phone' value='' onclick='searchreport(this)'>				
	</div>
	";
	
	$reports=getrows("select * from FBdata where status='7' order by first_name asc, last_name asc, createtstamp DESC limit 100");
	$rows=$reports[0][0];	
	echo "
		<div class='tabs' style='width:95%;'>			
			<div id='tab2' class='tab_property' style='background-color:#C8C8C8' onclick=location.href='reportdatabase.php'>Database</div>
			<div id='tab1' class='tab_property' style='background-color:#DFDDDD' onclick=location.href='reports.php'>Files</div>
		</div>
		<div id='content'>
		
		</div>
		
	<div id='divnumbers'>
			<table class='tablenumbers'>
				<tr>
					<td class='trnumbers'><input class='numbers' value='<<' id='12' onclick='findfirst();' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='<' id='0' onclick='decreasenumber();' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='1' id='1' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='2' id='2' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='3' id='3' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='4' id='4' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='5' id='5' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='6' id='6' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='7' id='7' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='8' id='8' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='9' id='9' onclick='viewreport(this);' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='>' id='10' onclick='increasenumber();' readonly/></td>
					<td class='trnumbers'><input class='numbers' value='>>' id='11' onclick='findlast();' readonly/></td>
				</tr>
			</table>
		</div>		
	";
	

	
	