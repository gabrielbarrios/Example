<link rel="stylesheet" href="../css/general.css" />
<script language="JavaScript" src ="../js/bottomindex.js"> </script>
<?php
	include_once("../header/private.php");
	
	echo("<a href='../private/'>HOME</a><br>");
	$valuemax = getvalue("SELECT count(*) FROM FBpull where status='7' and state>'0'");
	$valuemax = floor($valuemax/100)+1;
	echo "
		<input type='hidden' id='valuemax' value='$valuemax'/>
		<input type='hidden' id='start' value='1'/>
		<div class='tabs' style='width:80%;'>
			<div id='tab1' class='tab_property' style='background-color:#C8C8C8; margin-top: 2%;' onclick=location.href='reports.php'>Files</div>
			<div id='tab2' class='tab_property' style='background-color:#DFDDDD; margin-top: 2%;' onclick=location.href='reportdatabase.php'>Database</div>
		</div>
		
		<div class='search'>
				<input type='text' placeholder='Search' onKeyUp='searchreport(this);' value='' id='search'>
				
		</div>
		
		<div id='container'></div>
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
	
	
echo("
<script>

</script>
");
	
	