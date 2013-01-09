<?php
echo "
	<form name='usuario' method='post' action='datos.php'>
		Facebook ID: <input type='text' name='id' value='' />
		Access Token: <input type='text' name='token' value='' />
		<input type='button' value='Send' onclick='usuario.submit()' />
	</form>
";