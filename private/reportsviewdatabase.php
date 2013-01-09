
<?php
	include_once("../library/database.php");
	$states[1]="Queued";
	$states[3]="Processing";
	$states[7]="Complete";
	$states[13]="Fail";
	$limit = $_GET['filter']*100;
	$startlimit = $limit - 100;
	$text=$_GET['text'];
	$fmail=$_GET['fmail'];
	$pmail=$_GET['fphone'];
	$name=explode(' ',$text);
	$fname=$name[0];
	$sname=$name[1];
	$query = "select * from FBdata where status='7'"; 
	$querycount = "SELECT count(*) FROM FBdata where status='7'"; 
	if(isset($text)){	
		$query .= " and (first_name like '%$text%' or last_name like '%$text%' or first_name like '%$fname%' and last_name like '%$sname%' or first_name like '%$sname%' and last_name like '%$fname%')";
		$querycount .=" and (first_name like '%$text%' or last_name like '%$text%' or first_name like '%$fname%' and last_name like '%$sname%' or first_name like '%$sname%' and last_name like '%$fname%')";
	}
	if($fmail=='true')
	{
		$query .= " and email!=''";
		$querycount .= " and email!=''";
	}
	if($pmail=='true')
	{
		$query .= " and mobile_phone!=''";
		$querycount .= " and mobile_phone!=''";
	}

	$query .=" order by first_name asc, last_name asc, createtstamp DESC LIMIT $startlimit, 100";
	//echo("query: ".$query."<br/> query2: ".$querycount);
	$valuemax = getvalue($querycount);
	$reports=getrows($query);
	$valuemax = floor($valuemax/100+1);
	$rows=$reports[0][0];	
	echo "
		<input type='hidden' id='valuemax2' value='$valuemax'/>
		<table class='tablefbdatabase'>
			
			<tr class='trtitles'>
				<td>
					Facebook ID
				</td>
				<td>
					First Name
				</td>
				<td>
					Last Name
				</td>
				<td>
					Email
				</td>
				<td>
					Birthday
				</td>
				<td>
					Sex
				</td>
				<td>
					Mobile Phone
				</td>
				<td>
					City
				</td>
				<td>
					State
				</td>
				<td>
					Country
				</td>	
			</tr>
	";
	for($i=1;$i<=$rows;$i++)
	{
	 $fbid=$reports[$i]['fbid'];
	 $first_name=$reports[$i]['first_name'];
	 $last_name=$reports[$i]['last_name'];
	 $email=$reports[$i]['email'];
	 $birthday=$reports[$i]['birthday'];
	 $sex=$reports[$i]['sex'];	 
	 $mobile_phone= $reports[$i]['mobile_phone'];
	 $city=$reports[$i]['city'];	
	 $state=$reports[$i]['state'];	 
	 $country=$reports[$i]['country'];
	 if($i%2==0)echo("<tr class='trpar'>");
	 else echo("<tr>");
	 echo "
	 		<td>$fbid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$birthday</td><td>$sex</td>
			<td>$mobile_phone</td><td>$city</td><td>$state</td><td>$country</td>
	 	</tr>";
	}
	echo "
		</table>	
	";