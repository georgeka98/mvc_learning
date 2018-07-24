function get_videos_num(){
  return document.getElementById("videos-list").children.length;
}

document.getElementById("load_more_videos").addEventListener('click', function(){
  document.getElementById("load_more_videos").style.display = "none";
  document.getElementById("loader").style.display = "block";
  toggle_nav();
  load_more_videos(xmlHttp,"http://192.168.64.2/mvclearn/youtubevideos/ajax/more_videos");
}, false);

function load_more_videos(xmlHttp,file_location){
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
    var videos_num = get_videos_num();
	  xmlHttp.open("GET", file_location+"/"+videos_num, true); //Creates the request. true is to make the request asynchronous
		//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
		xmlHttp.onreadystatechange = function(){
      if(this.readyState==4){ //if the oibject is done communicating and response is ready
    		if(this.status==200){ //if communication went ok (so 200 means that communication was successful)
    			// //alert(xmlHttp.responseText)
    			// xmlResponse = xmlHttp.responseXML; //exttracting the xml file from the registerVal.php file
    			// xmlDocumentElement = xmlResponse.documentElement; //root of the xml file
    			// message = xmlDocumentElement.firstChild.data; //gets the result from the code executed within the response tags
    			// postsEl.removeChild(postsEl.children[postsEl.children.length-1]);
    			// document.getElementsByClassName('comments')[0].innerHTML = document.getElementsByClassName('comments')[0].innerHTML + message;
          document.getElementsByClassName("videos-cont")[0].innerHTML  += this.responseText;
          document.getElementById("loader").style.display= "none";
          document.getElementById("load_more_videos").style.display = "block";
          document.getElementsByClassName("videos-cont")[0].style.display = "inline-block";
    		}
    	}
		}
		xmlHttp.send(null); //sends the request ot the server
	}
	else{
		setTimeout('load_more_videos(file_location)',1000);
	}
}

window.addEventListener("load", function(){
  console.log(document.getElementById("videos-list").children)
  if (document.getElementById("videos-list").children.length == 0){
    document.getElementById("loader").style.display= "block";
    load_more_videos(xmlHttp,"http://192.168.64.2/mvclearn/youtubevideos/ajax/more_videos");
  }
}, false);
