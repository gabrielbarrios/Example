<?php
	include_once("../library/private.php");
	$createstamp=time();	
	
	// we are creating profile here
	$query=getvalue("select userid from FBprofile where status=7 and userid=$userid;");
	if($query)
	{
		doquery("update FBprofile set lasttstamp=$createstamp where userid=$userid and status=7");
	}
	else
	{				
		doquery("insert into FBprofile set userid=$userid, fbid='$fid', createtstamp='$createstamp', lasttstamp='$createstamp', fbemail='$fbemail', status='7', username='$username'");		
	}	
		
		
// we are creating token here		
	$tokenid=doquery("insert into FBtoken set userid=$userid, fbid='$fid', fbtoken='$token', fbemail='$fbemail', createtstamp='$createstamp', status='7', state='1', username='$username'");				
	
	
// we are creating the pull here	

	if($pullinfo=getrow("select * from FBpull where fbid='$fid' and status='7'"))
	{
	 $pullstate=$pullinfo['state'];
	 $pulllast=$pullinfo['lastpullend'];
	 $pullid=$pullinfo['id'];
	 $lastweek=time()-24*60*60*7;
	 
	 if($pullstate==7 and $pulllast<$lastweek)
	 {
	  doquery("update FBpull set fbid='$fid', state='1', createtstamp='$createstamp', 
	    status='7', fbtoken='$token', userid='$userid', level='1', username='$username'
	   where fbid='$fid' and status='7'");
	 }		
	}
	else
	{		
	 $pullid=doquery("insert into FBpull set fbid='$fid', 
	  state='1', createtstamp='$createstamp', fbtoken='$token', name='$uname', userid='$userid', level='1', username='$username', status='7'");		
	}
		
// we are the pull link here	
	if($pulltokenid=getvalue("select id from FBpulltoken where tokenid='$tokenid' and pullid='$pullid'"))
	{
	 doquery("update FBpulltoken set status='7' where id='$pulltokenid'");
	}
	else
	{
	 doquery("insert into FBpulltoken set tokenid='$tokenid', pullid='$pullid', status='7', userid='$userid', username='$uname'");		
	}
	
	header("location: data.php");