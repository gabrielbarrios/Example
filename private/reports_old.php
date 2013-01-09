<link rel="stylesheet" href="../css/general.css" />
<?php
	include_once("../header/private.php");
	
	echo("<a href='../private/'>HOME</a><br>");
	$states[2]="Queued";
	$states[3]="Processing";
	$states[7]="Complete";
	$states[13]="Fail";
	
	$reports=getrows("select * from FBtoken where status='7' and state>'1' order by createtstamp DESC limit 100");
	$rows=$reports[0][0];
	echo "
		<table class='tablefbtoken'>
			<tr class='trtitles'>
				<td>
					View
				</td>
				<td>
					UserName
				</td>	
				<td>
					Facebook ID
				</td>
				<td>
					State
				</td>
				
				<td>
					CreateStamp
				</td>
			</tr>
	";
	for($i=1;$i<=$rows;$i++)
	{
	 $userid=$reports[$i]['userid'];
	 $createtstamp=$reports[$i]['createtstamp'];
	 $fbid=$reports[$i]['fbid'];
	 $state=$reports[$i]['state'];
	 $statename=$states[$state];
	 $username=$reports[$i]['username'];
	 $fbtokenid = $reports[$i]['id'];
	 $createtstamp = date("m-d-Y H:i:s", $createtstamp); 
	 
	 if($i%2==0)echo("<tr class='trpar'>");
	 else echo("<tr>");

  

	 echo "
	 		<td>";
	 				if (file_exists("../reports/fb.$fbtokenid.csv")) 
	 		echo "<a href='../reports/fb.$fbtokenid.csv' target='_blank'><img src='../images/lupa.png' id=$fbtokenid'/></a>";
	 		
	 		echo "</td>
	 		<td>$username</td><td>$fbid</td><td>$statename</td><td>$createtstamp</td>
	 	</tr>";
	}
	echo "
		</table>
		
	";
	
	
	