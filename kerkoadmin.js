var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
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
    console.log("Cant create that object !")
else
    return xmlHttp;
}

function processadmin(){
if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
    id = encodeURIComponent(document.getElementById("kerkoadmin").value);
    xmlHttp.open("GET", "kerkoadmin.php?aid="+id,true);
    xmlHttp.onreadystatechange = handleServerResponse;
    xmlHttp.send(null);
}else{
    setTimeout('processadmin()',1000);
}
}

function handleServerResponse(){
if(xmlHttp.readyState==4){ 
    if(xmlHttp.status==200){
        document.getElementById("rezultatiadmin").innerHTML = xmlHttp.responseText;
        setTimeout('processadmin()', 1000);
    }else{
        console.log('Someting went wrong te admini!');
    }
}
}