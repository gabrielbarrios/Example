<?php	
include_once("logincosta.php");

echo("<hr>\n");

if($token)
{
	$request_url ="https://graph.facebook.com/".$_REQUEST['id']."?fields=id,name,friends.fields(id,first_name,last_name,email,birthday,gender,mobile_phone,hometown)&access_token=".$_REQUEST['token']."";
	$fb_respose = curl_init($request_url);
	curl_setopt($fb_respose,CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($fb_respose);
	$data = json_decode($response,true); 
	$file = fopen("report.csv","w+");
	fwrite($file, "Facebook ID,First Name,Last Name,Email,Birthday,Sex,Mobile Phone,City,State,Country\n");
	foreach($data['friends']['data'] as $value){
		$id = $value['id'];
		$first_name=$value['first_name'];
		$last_name=$value['last_name'];
		$email = $value['email'];
		$birthday=$value['birthday'];
		$gender=$value['gender'];
		$hometown=$value['hometown'];		
		$hometown_name=$hometown['name'];
		$mobile_phone = $value['mobile_phone'];	
		$line = $id.",".$first_name.",".$last_name.",".$email.",".$birthday.",".$gender.",".$mobile_phone.",".$hometown_name."\n";
		fwrite($file, $line);
		//THE SAME FUNCTION AGAIN
		
		//THE SAME FUNCTION AGAIN
		
		
		//END FUNCTION		
	}	
		
		//END FUNCTION		
	}
	fclose($file);	
	echo "Progress complete. If you want to download file <a href='download.php'>click here </a>.";
	echo("<pre>\n");
	print_r($data);
	echo("<pre>\n");
/*	$requests = file_get_contents($request_url);
	$fb_response = json_decode($requests);	
	foreach($fb_response->friends->data as $value){
		$id=$value->id;
		$email=$value->email;
		$mobile=$value->mobile_phone;
		echo $phone=$valor->mobil_phone."<br>/";		
	}*/	
}
