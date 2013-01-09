<link rel="stylesheet" href="../css/general.css" />
<style>
td{
	width: 150px;
}
</style>
<?php
	include_once("../header/private.php");
	$fbtokenid = $_GET['fbtokenid'];
	$loop1=0;
	echo ("
		<table class='tablefbtoken' style='width:95%;'>
	");
	$fname="../reports/fb.pull.".$fbtokenid.".csv"; 
	$fp = fopen ( $fname , "r" ); 
	while (( $data = fgetcsv ( $fp , 2048, ",","\n" )) !== false ) {  
		if($loop1==0)
		{
			echo("<tr class='trtitles'>");
		}
		elseif($loo1%2!=0)
		{
			echo("<tr>");	
		}
		else
		{
			echo("<tr class='trpar'>");	
		}
		foreach($data as $row) {
			$row = str_replace ("\"","",$row);
			echo "<td>$row</td>";
		}
		echo '</tr>';
		$loop1++;
	
	} 
	fclose ( $fp ); 
	echo ("
		</table>
	");
