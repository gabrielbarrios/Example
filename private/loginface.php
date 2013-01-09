<?php	
	include("../header/private.php");
	echo "
		<table border='0'>
		<form action='process_login.php' method='post' name='logface'>
			<tr>
				<td>Facebook Email:</td>
				<td>
					<input type='text' name='user' value='' id='user' onblur='checkemail(this)'/>
					<div id='fupload-user' style='color:red;'></div>
				</td>
			</tr>
			<tr>
				<td>Facebook Password:</td>
				<td>
					<input type='password' name='pass' value='' id='pass' onkeyup='checkvoid(this);'/>
					<div id='fupload-pass' style='color:red;'></div>
				</td>
			</tr>
			<tr><td colspan='2'><input type='button' value='Generate Data' onclick='checksave();'/></td></tr>
			<tr><td colspan='2'><a href='../private/'>HOME</a></tr>
		</form>
		</table>
	";
	
	echo("
	<script>

		function checksave()
		{
			var log = document.getElementById('user').value;
			var pas = document.getElementById('pass').value;
			if(log=='')
			{
				document.getElementById('fupload-user').innerHTML='Required Email';
			}
			if(pas=='')
			{
				document.getElementById('fupload-pass').innerHTML='Required Password';
			}
			if(pas!='' & log!='')
			{
				document.logface.submit();
			}
		}
		function checkvoid(input)
		{
				document.getElementById('fupload-'+input.id).innerHTML='';
				
		}
		
		function checkemail(email) {							//onblur='checkemail(this)' onkeyup='checkemail(this)'
		    var RegExPattern = /[\w-\.]{1,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    if ((email.value.match(RegExPattern)) || (email.value=='')) {
		    	document.getElementById('fupload-'+email.id).innerHTML='';
		        
		    } else {
		    	document.getElementById(email.id).focus();
		        document.getElementById('fupload-'+email.id).innerHTML='incorrect email';
		    } 
		}
		
	</script>
	");
