<?php
	include("../header/private.php");
		echo "
		<form name='usuario' method='post' action='data.php'>
			Facebook ID: <input type='text' name='fbid' value='".$_REQUEST['fid']."' />
			<input type='hidden' name='token' value='".$_REQUEST['access_token']."' />
			<input type='button' value='Send' onclick='usuario.submit()' />
			<a href='../public/logout.php'>HOME</a>
		</form>			
		";		