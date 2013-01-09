
<?php
	include_once("../library/database.php");
	$states[1]="Queued";
	$states[3]="Processing";
	$states[7]="Complete";
	$states[13]="Fail";
	$search = $_GET['search'];
	$limit = $_GET['filter']*100;
	$startlimit = $limit - 100;
	$query = "select * from FBpull where status='7' and state>'0'";
	if(isset($search)){
		$query .= " and name like '%$search%'";
		$valuemax = getvalue("SELECT count(*) FROM FBpull where status='7' and state>'0' and name like '%$search%'");
	}
	else{
		$valuemax = getvalue("SELECT count(*) FROM FBpull where status='7' and state>'0'");
	}
	//$reports2=getrows($query);
	//$rows2=$reports2[0][0];
	$valuemax = floor($valuemax/100+1);
	$query .=" order by state desc, createtstamp DESC LIMIT $startlimit, 100";
	$reports=getrows($query);
	$rows=$reports[0][0];	
	echo "
		<input type='hidden' id='valuemax2' value='$valuemax'/>
		<table class='tablefbtoken'>
			
			<tr class='trtitles'>
				<td>
					View
				</td>
				<td>
					Name 
				</td>
				<td>
					Created
				</td>
				<td>
					Status
				</td>
			</tr>
	";
	for($i=1;$i<=$rows;$i++)
	{
	 $fbid=$reports[$i]['fbid'];
	 $name=$reports[$i]['name'];
	 $createtstamp=$reports[$i]['createtstamp'];
	 $state=$reports[$i]['state'];
	 $statename=$states[$state];
	 $fbtokenid = $reports[$i]['id'];
	 $createtstamp = date("m-d-Y H:i:s", $createtstamp); 
	 if($i%2==0)echo("<tr class='trpar'>");
	 else echo("<tr>");
	 echo "
	 		<td>";
	 				if (file_exists("../reports/fb.pull.$fbtokenid.csv")) 
	 		echo "<a href='../reports/fb.pull.$fbtokenid.csv' target='_blank'><img src='../images/lupa.png' id=$fbtokenid'/></a>";

	 		echo "</td>
	 		<td>$name</td><td>$createtstamp</td><td>$statename</td>
	 	</tr>";
	}
	echo "
		</table>	
	";