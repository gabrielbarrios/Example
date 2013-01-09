<?php	
	include("../library/private.php");
	
	
	if($id=getvalue("select id from FBtoken where userid='$userid' and state='1'"))
	{
		doquery("update FBtoken set state='2', fbid='$fbid' where id='$id'");
	}
	//header("location: ../scripts/getfriends.php");
	header("location: reports.php");