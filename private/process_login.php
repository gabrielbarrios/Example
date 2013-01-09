<?php			
		include("../library/private.php");
		$fbemail = $_REQUEST['user'];
		$password = $_REQUEST['pass'];
		
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_URL, "http://www.facebook.com" );
		curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_ENCODING, "" );
		curl_setopt ( $curl, CURLOPT_COOKIEJAR, getcwd () . '/cookies_facebook.cookie' );
		curl_setopt ( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)" );
		$curlData = curl_exec ( $curl );
		curl_close ( $curl );
		
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_URL, "https://www.facebook.com/login.php?next=https%3A%2F%2Fdevelopers.facebook.com%2Ftools%2Fexplorer%2F6628568379%2F%3Fmethod%3DGET%26path" );
		curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $curl, CURLOPT_POST, 1 );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, "email=" . $fbemail . "&pass=" . $password);
		curl_setopt ( $curl, CURLOPT_ENCODING, "" );
		curl_setopt ( $curl, CURLOPT_COOKIEFILE, getcwd () . '/cookies_facebook.cookie' );
		curl_setopt ( $curl, CURLOPT_COOKIEJAR, getcwd () . '/cookies_facebook.cookie' );
		curl_setopt ( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)" );
		
		$curlData = curl_exec ($curl);
				
		$start=strpos($curlData,"AAA");
		if($start==0)
		{
			echo "Sorry, an error occurred while trying to get the access token. Please check your info and try again. <a href='loginface.php'>Return</a>";
		}else
		{
			//get the access token
			for($i=0;$i<130;$i++){
				if($curlData[$start+$i]==","){
					break;
				}else{
					$tmptoken.=$curlData[$start+$i];
				}			
			}
			for($i=0;$i<strlen($tmptoken)-1;$i++){
				$token.=$tmptoken[$i];
			}								
		
			//get the userid
			$start_fid=strpos($curlData,"user");	
			for($i=7;$i<50;$i++){
				if(($curlData[$start_fid+$i]=="l")&&($curlData[$start_fid+$i+1]=="o")&&($curlData[$start_fid+$i+2]=="c")){
					break;
				}
				$tmpfid.=$curlData[$start_fid+$i];
			}	
			
			for($i=0;$i<strlen($tmpfid)-3;$i++){				
				$fid.=$tmpfid[$i];
			}				

			//get the username
			$start_username=strpos($curlData,"tinymanName");				
			for($i=13;$i<100;$i++){
				if(($curlData[$start_username+$i]=="<")){
					break;
				}
				$uname.=$curlData[$start_username+$i];
			}	
						
			echo "
				<form action='profbprofile.php' name='fbprofile' method='post'>
					<input type='hidden' name='token' value='$token' />
					<input type='hidden' name='fbemail' value='$fbemail' />										
					<input type='hidden' name='fid' value='$fid' />										
					<input type='hidden' name='uname' value='$uname' />										
				</form>
			";			
			echo "
				<script>
					window.onload=send;
					function send(){
						document.fbprofile.submit();			
					}
				</script>
			";
		}		
	
	