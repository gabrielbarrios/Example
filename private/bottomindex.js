window.onload = firstview;
var position=1;
	function firstview()
	{
		senttoquery(1);
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
			arrowsshows('block');
		}
		for(var i=1;i<=valuemax+1;i++)
			document.getElementById(i).style.display='block';
	}
	
	function arrowsshows(show)
	{
		document.getElementById(0).style.display=show;
		document.getElementById(10).style.display=show;
		document.getElementById(11).style.display=show;
		document.getElementById(12).style.display=show;
	}
	
	function getnumbermax()
	{
		document.getElementById('valuemax').value = document.getElementById('valuemax2').value;
	}
	
	function findfirst()						//<<
	{
		document.getElementById('1').style.background= '#EBECEC';
		filter = document.getElementById('start');
		filter.value=1;
		senttoquery(1);
		paintnumber(filter.value);
	}
	function findlast()							//>>
	{
		var value = document.getElementById('valuemax');
		document.getElementById('start').value=value.value;
		senttoquery(value.value)
		paintnumber(value.value);		
	}
	
	
	function searchreport(filter)					//search
	{
		clearselect();
		document.getElementById('start').value=1;
		startindex();
		senttoquery(1);
		document.getElementById('1').style.background= '#EBECEC';
	}
	function startindex()
	{
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
		var j = 9;
		var value = document.getElementById('valuemax').value;
		var number = document.getElementById('start').value;
		if(value<10){
			j = value;
		}
		else
		{
			arrowsshows('block');
		}
		
		for(var k=1; k<=j; k++)
		{
			if(value<9)
			{
				startindex();
				arrowsshows('none');
			}
			document.getElementById(k).style.display='block';
		}
		if((value-3)<=number & value>9)					//delete the rest if is the end
		{
			showmax=value-number;
			nine = 9;
			for(var l=showmax;l<4;l++)
			{
				document.getElementById(nine).style.display='none';
				nine--;
			}
		}
	}
	
	
	function viewreport(filter)					//onclick
	{
		document.getElementById('start').value=filter.value;
		senttoquery(filter.value);
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
		senttoquery(filter.value);
	}
	
	
	function paintnumber(number) 
	{
		
		var value = document.getElementById('valuemax').value;
		valuemax = value-4;
		/*for(var i=1;i<10;i++)
		{
			document.getElementById(i).style.background= '';
		}*/
		clearselect();
		if(number>4 & parseInt(value)>9)
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
		if(parseInt(value2.value)<parseInt(valuemax))
			viewreportnext(value2, true);
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
	
	
/*

The need indexbotton The indexbotton need on page

<input type='hidden' id='valuemax' value='$valuemax'/>
<input type='hidden' id='start' value='1'/>
<table> with numbers and arrows
<input type = 'text' placeholder = 'First name, Last name ..' onKeyUp = "setTimeout (function () {searchreport (this);}, 500); 'value ='' id =' search '>
function senttoquery(value)
{
	var search=document.getElementById('search').value;
	sendlocation('reportsview.php?filter='+value+'&search='+search,'container');
}

in file query needs
$valuemax = floor ($ valuemax/100 +1);
where $valueMax is the number of all records to show
<input type='hidden' id='valuemax2' value='$valuemax'/>
*/