var xmlHttp = createXmlHttpRequestObject();
y="";

function createXmlHttpRequestObject()
{
	var xmlHttp;

	if(window.ActiveXObject){ 
	    try{
	        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }catch(e){
	        xmlHttp = false;
	    }
	}else{ 
	    try{
	        xmlHttp = new XMLHttpRequest();
	    }catch(e){
	        xmlHttp = false;
	    }
	}

	if(!xmlHttp)
	    alert("Cant create that object !")
	else
	    return xmlHttp;
}

function processorder()
{

	ul = document.getElementById("myList");
	var x;
	for(var i = 0;i<ul.childNodes.length;i++)
	{
		if(ul.childNodes[i].nodeName === 'LI')
		{
			switch(ul.childNodes[i].innerHTML.toUpperCase())
			{//outputs categories with their order
				case "1. Fjali me fjalë që mungojnë".toUpperCase():
					x=1;y+="~~"+x;break;
				case "2. Shkruaj përgjigjen".toUpperCase():
					x=2;y+="~~"+x;break;
				case "3. Me alternativa(A/B/C/D...)".toUpperCase():
					x=3;y+="~~"+x;break;
				case "4. Me alternativa(PO/JO)".toUpperCase():
					x=4;y+="~~"+x;break;					
				case "5. Me fotografi".toUpperCase():
					x=5;y+="~~"+x;break;
			}
			document.getElementById('orderstorage').value=y;
		}
	}

	if(xmlHttp.readyState==0 || xmlHttp.readyState==4)
	{
	    xmlHttp.open("GET", "order.php?txt="+y,true);
	    console.log(y);
	    alert('Ndryshimet u ruajtën me sukses!');
	    xmlHttp.onreadystatechange = handleServerResponses;
	    xmlHttp.send(null);
	}
	else//error on AJAX request
	{
		alert("OOOPS");
	}
	y="";

}

var lis = [];

function handleServerResponses()//display AJAX request results
{
	if(xmlHttp.readyState==4)
	{ 
	    if(xmlHttp.status==200)
		{
			/*ul = document.getElementById("myList");
			var list=[];
		    //add to array
			for(var i = 0;i<ul.childNodes.length;i++)
			{
       			if(ul.childNodes[i].nodeName === 'LI')
   		 		{
   			 		list.push(ul.childNodes[i].innerHTML);
   			 		alert(ul.childNodes[i].innerHTML);
   			 	}
    		}*/

    		//

    		text=xmlHttp.responseText;
    		p=text.split('==')[1];			
			p=p.split('**')[0];
			p=p.slice(0,-1);
			p=p.slice(1).trim();
			console.log(p);

			p=text.split('Ö')[1];			
			p=p.split('Ä')[0];
			p=p.slice(0,-1);
			p=p.slice(1).trim();
			document.getElementById('displayorder').innerHTML=p;
	    }
	    else
	    {
	        alert('Someting went wrong !');
	    }
	}
}
