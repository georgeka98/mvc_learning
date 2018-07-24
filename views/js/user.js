function get_comments(xmlHttp,file_location){
	if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
	  xmlHttp.open("GET", file_location, true); //Creates the request. true is to make the request asynchronous
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
          document.getElementsByClassName('comments')[0].innerHTML = this.responseText;
    		}
    	}
		}
		xmlHttp.send(null); //sends the request ot the server
	}
	else{
		setTimeout('load_more_videos(file_location)',1000);
	}
}

document.getElementById("newest").addEventListener("click", function(){
	var comment_wrap = document.getElementsByClassName('comments')[0];
  var user_id = comment_wrap.dataset.profileUserId;

	document.getElementById("newest").className = "active";
	document.getElementById("rating").className = "";

	var show = document.getElementsByClassName("comment-type")[0].getElementsByClassName("active")[0].id;

	document.getElementById("rating").style.color ='#ffffff';
	document.getElementById("rating").style.backgroundColor ='#474647';
	document.getElementById("newest").style.color ='#474647';
	document.getElementById("newest").style.backgroundColor ='#ffffff';
  get_comments(xmlHttp,"http://192.168.64.2/mvclearn/user/ajax/comments/"+user_id+"/"+show+"/newest");

}, false);

document.getElementById("rating").addEventListener("click", function(){
	var comment_wrap = document.getElementsByClassName('comments')[0];
  var user_id = comment_wrap.dataset.profileUserId;

	document.getElementById("newest").className = "";
	document.getElementById("rating").className = "active";

	var show = document.getElementsByClassName("comment-type")[0].getElementsByClassName("active")[0].id;

	console.log(show)

	document.getElementById("rating").style.color ='#474647';
	document.getElementById("rating").style.backgroundColor ='#ffffff';
	document.getElementById("newest").style.color ='#ffffff';
	document.getElementById("newest").style.backgroundColor ='#474647';
  get_comments(xmlHttp,"http://192.168.64.2/mvclearn/user/ajax/comments/"+user_id+"/"+show+"/rating");
}, false);

document.getElementById("comments").addEventListener("click", function(){
	var comment_wrap = document.getElementsByClassName('comments')[0];
  var user_id = comment_wrap.dataset.profileUserId;

	document.getElementById("replies").className = "";
	document.getElementById("comments").className = "active";

	var show = document.getElementsByClassName("order-by")[0].getElementsByClassName("active")[0].id;

	document.getElementById("comments").style.color ='#474647';
	document.getElementById("comments").style.backgroundColor ='#ffffff';
	document.getElementById("replies").style.color ='#ffffff';
	document.getElementById("replies").style.backgroundColor ='#474647';
  get_comments(xmlHttp,"http://192.168.64.2/mvclearn/user/ajax/comments/"+user_id+"/comments/"+show);
}, false);

document.getElementById("replies").addEventListener("click", function(){
	var comment_wrap = document.getElementsByClassName('comments')[0];
  var user_id = comment_wrap.dataset.profileUserId;

	document.getElementById("replies").className = "active";
	document.getElementById("comments").className = "";

	var show = document.getElementsByClassName("order-by")[0].getElementsByClassName("active")[0].id;

	document.getElementById("replies").style.color ='#474647';
	document.getElementById("replies").style.backgroundColor ='#ffffff';
	document.getElementById("comments").style.color ='#ffffff';
	document.getElementById("comments").style.backgroundColor ='#474647';
  get_comments(xmlHttp,"http://192.168.64.2/mvclearn/user/ajax/comments/"+user_id+"/replies/"+show);
}, false);

window.addEventListener("load", function(){
  var comment_wrap = document.getElementsByClassName('comments')[0];
  var user_id = comment_wrap.dataset.profileUserId;
  get_comments(xmlHttp,"http://192.168.64.2/mvclearn/user/ajax/comments/"+user_id+"/comments/newest");
}, false);
