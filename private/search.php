<?php	
	include_once("../header/public.php");
	$text=$_GET['text'];
	$fmail=$_GET['fmail'];
	$pmail=$_GET['fphone'];
	$name=explode(' ',$text);
	$fname=$name[0];
	$sname=$name[1];
	$limit = $_GET['filter']*100;
	$startlimit = $limit - 100;	
	if($text=='')
	{
	 $reports=getrows("select * from FBdata where status='7' order by first_name asc, last_name asc, createtstamp DESC limit $startlimit, 100");				
	}
	else
	{
	 $reports=getrows("select * from FBdata where 
	 (first_name like '%$text%' or last_name like '%$text%') or	 
	 (first_name like '%$fname%' and last_name like '%$sname%') or
	 (first_name like '%$sname%' and last_name like '%$fname%') and
	 status='7' order by first_name asc, last_name asc, createtstamp DESC limit $startlimit, 100");
	}
	$rows=$reports[0][0];	
	
	echo "
		<br>
		<table class='tablefbdatabase'>
			</tr>
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
		if($fmail=='true')
		{
			if($pmail=='true')
			{
				if($mobile_phone && $email)
				{
					echo "
						<td>$fbid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$birthday</td><td>$sex</td>
						<td>$mobile_phone</td><td>$city</td><td>$state</td><td>$country</td>
					</tr>";		
				}
			}
			else
			{
				if($email)
				{
					echo "
						<td>$fbid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$birthday</td><td>$sex</td>
						<td>$mobile_phone</td><td>$city</td><td>$state</td><td>$country</td>
					</tr>";		
				}
			}
		}
		if($fmail=='false')
		{
			if($pmail=='true')
			{
				if($mobile_phone)
				{
					echo "
						<td>$fbid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$birthday</td><td>$sex</td>
						<td>$mobile_phone</td><td>$city</td><td>$state</td><td>$country</td>
					</tr>";		
				}
			}
			else
			{
				echo "
					<td>$fbid</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$birthday</td><td>$sex</td>
					<td>$mobile_phone</td><td>$city</td><td>$state</td><td>$country</td>
				</tr>";		
			}
		}
		
		
	}
	echo "
		</table>
	";