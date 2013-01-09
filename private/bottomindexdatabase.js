window.onload = firstview;
var position=1;
	function firstview()
	{
		//var filter = 'search.php?filter=1';
		//sendlocation(filter,'content');
		sendlocation('reportsviewdatabase.php?filter=1','content');
		document.getElementById('1').style.background= '#EBECEC';
		var valuemax = document.getElementById('valuemax').value;
		for(var j=1;j<10;j++)
		{
			document.getElementById(j).style.display='none';
		}
		if(valuemax <= 1 )
			valuemax=-1;
		if(valuemax>9)
		{
			valuemax=8;
			document.getElementById(0).style.display='block';
			document.getElementById(10).style.display='block';
			document.getElementById(11).style.display='block';
			document.getElementById(12).style.display='block';
		}
		for(var i=1;i<=valuemax+1;i++)
			document.getElementById(i).style.display='block';
	}
	
	function getnumbermax()
	{
		document.getElementById('valuemax').value = document.getElementById('valuemax2').value;
	}
	
	function findfirst()						//<<
	{
		//var search=document.getElementById('search').value;
		document.getElementById('1').style.background= '#EBECEC';
		filter = document.getElementById('start');
		filter.value=1;
		fphone = document.getElementById('phone').checked;
		fmail = document.getElementById('email').checked;
		text = document.getElementById('search').value;
		paintnumber(filter.value);
		sendlocation('reportsviewdatabase.php?filter=1&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content');
	}
	function findlast()							//>>
	{
		//var search=document.getElementById('search').value;
		var value = document.getElementById('valuemax');
		document.getElementById('start').value=value.value;
		fphone = document.getElementById('phone').checked;
		fmail = document.getElementById('email').checked;
		text = document.getElementById('search').value;
		sendlocation('reportsviewdatabase.php?filter='+value.value+'&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content');
		paintnumber(value.value);		
	}
	
	
	function searchreport(filter)					//search
	{
		clearselect();
		document.getElementById('start').value=1;
		fphone = document.getElementById('phone').checked;
		fmail = document.getElementById('email').checked;
		text = document.getElementById('search').value;
		//setTimeout( sendlocation('reportsviewdatabase.php?filter=1&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content'), 5000 );
		sendlocation('reportsviewdatabase.php?filter=1&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content');
		document.getElementById('1').style.background= '#EBECEC';
	}
	
	function clearselect()
	{
		for(var i=1;i<10;i++)
		{
			document.getElementById(i).style.background = '';
		}
	}
	
	function searchview()
	{
		for(var i=1;i<10;i++)
		{
				document.getElementById(i).style.display='none';	
		}
		var j = 10;
		var value = document.getElementById('valuemax').value;
		var number = document.getElementById('start').value;
		if(value<10){
			j = value;
		}
		else
		{
			document.getElementById('0').style.display='block';
			document.getElementById('10').style.display='block';
			document.getElementById('11').style.display='block';
			document.getElementById('12').style.display='block';
		}
		
		//num = 1;
		for(var k=1; k<=j; k++)
		{
			if(value<9){
				document.getElementById('1').value = 1;
				document.getElementById('2').value = 2;
				document.getElementById('3').value = 3;
				document.getElementById('4').value = 4;
				document.getElementById('5').value = 5;
				document.getElementById('6').value = 6;
				document.getElementById('7').value = 7;
				document.getElementById('8').value = 8;
				document.getElementById('9').value = 9;
			}
			//num++;
			document.getElementById(k).style.display='block';
		}
		if((value-3)<=number)					//delete the rest if is the end
		{
			showmax=value-number;
			nine = 9;
			for(var l=showmax;l<4;l++){
				document.getElementById(nine).style.display='none';
				nine--;
			}
		}
	}
	
	
	function viewreport(filter)					//onclick
	{
		document.getElementById('start').value=filter.value;
		fphone = document.getElementById('phone').checked;
		fmail = document.getElementById('email').checked;
		text = document.getElementById('search').value;
		sendlocation('reportsviewdatabase.php?filter='+filter.value+'&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content');
		paintnumber(filter.value);
	}
	
	function viewreportnext(filter, next) 		//< or >
	{
		if(next)
		{
			filter.value++;
		}
		else
		{
			filter.value--;
		}
		paintnumber(filter.value);
		position=filter.value;
		document.getElementById(filter.id).style.background= '#EBECEC';
		//var search=document.getElementById('search').value;
		fphone = document.getElementById('phone').checked;
		fmail = document.getElementById('email').checked;
		text = document.getElementById('search').value;
		sendlocation('reportsviewdatabase.php?filter='+filter.value+'&text='+text+'&fmail='+fmail+'&fphone='+fphone,'content');
	}
	
	
	function paintnumber(number) 
	{
		
		var value = document.getElementById('valuemax').value;
		valuemax = value-4;
		for(var i=1;i<10;i++)
		{
			document.getElementById(i).style.background= '';
			//document.getElementById(i).style.display='block';
		}
			
		if(number>=valuemax)
		{
			var num=number-value;
			num = 6-num;
			for(var k=num; k<10; k++)
			{
				document.getElementById(k).style.display='none';
			}	
		}
		
		if(number>4)
		{
			number-=5;
			for(var i=1; i<10;i++)
			{
				number++;
				document.getElementById(i).value=number;
			}
			document.getElementById('5').style.background= '#EBECEC';
		}	
		else
		{
			for(var j=1;j<10;j++)
				document.getElementById(j).value=j;
			document.getElementById(number).style.background= '#EBECEC';
		}
		
	}
	
	
	function decreasenumber()
	{
		var value = document.getElementById('start');
		if(value.value>1)
			viewreportnext(value, false);
	}
	function increasenumber()
	{
		var value2 = document.getElementById('start');
		var valuemax = document.getElementById('valuemax').value;
		if(parseInt(value2.value)<parseInt(valuemax)){
			viewreportnext(value2, true);
		}
	}

/*ajax*/



	function ajaxFunction() 
	{
	  var xmlHttp;
	  
	  try 
	  {
	   
	    xmlHttp=new XMLHttpRequest();
	    return xmlHttp;
	  } catch (e) {
	    
	    try 
	    {
	      xmlHttp=new ActiveXObject('Msxml2.XMLHTTP');
	      return xmlHttp;
	    } catch (e) {
	      
		  try 
		  {
	        xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');
	        return xmlHttp;
	      } catch (e) {
	        alert('Your browser does not support AJAX!');
	        return false;
	      }}}
	}
	
	
	function sendlocation(_page,container) 
	{
	    var ajax;
	    ajax = ajaxFunction();
	    ajax.open('POST', _page, true);
	    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    ajax.onreadystatechange = function() 
	    {
			if (ajax.readyState==1)
			{
				document.getElementById(container).innerHTML = ' Loading...';
			}
			if (ajax.readyState == 4) 
			{
	            document.getElementById(container).innerHTML=ajax.responseText;
	            getnumbermax();
	            searchview();
	            
			}
		}		 
		ajax.send(null);
	}