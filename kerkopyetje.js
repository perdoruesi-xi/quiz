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

function processpyetje(){
if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
    txt = encodeURIComponent(document.getElementById("kerkopyetje").value);
    xmlHttp.open("GET", "kerkopyetje.php?txt="+txt,true);
    xmlHttp.onreadystatechange = handleServerResponse;
    xmlHttp.send(null);
}else{
    setTimeout('processpyetje()',1000);
}
}

function handleServerResponse(){
if(xmlHttp.readyState==4){ 
    if(xmlHttp.status==200){
        document.getElementById("rezultatipyetje").innerHTML = xmlHttp.responseText;
        setTimeout('processpyetje()', 1000);
    }else{
        console.log('Someting went wrong !');
    }
}
}