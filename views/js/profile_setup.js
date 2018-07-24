var fileSelect = "";
var uploadButton = "";
if(document.getElementById('file-select') != undefined){
	fileSelect = document.getElementById('file-select');
}
if(document.getElementById('upload-button') != undefined){
	uploadButton = document.getElementById('upload-button');
}
var filename = "";
var height = "";
var width = "";

var canvas = "";
var context = "";
if(document.getElementById('img-preview') != undefined){
	canvas = document.getElementById('img-preview');
	context = canvas.getContext('2d');
}

// file selection
if(fileSelect != "" && uploadButton != ""){
	uploadButton.addEventListener('click', function(){

		// cancel event and hover styling
		// FileDragHover(e);
		uploadButton.innerHTML = 'Uploading...';
		// // fetch FileList object
		// var files = e.target.files || e.dataTransfer.files;
		//getting the file uploaded
		var file = fileSelect.files[0];
		// alert(file.name+" "+file.size+" "+file.type);
		filename = file.name;
		var formdata = new FormData();
		formdata.append("file-select", file);
		upload(formdata);
	});

	function completeHandler(event){
		document.getElementById('status').innerHTML = 'Upload completed';
		//document.getElementById('progressBar').value = 0;
	}

	function progressHandler(event){
		document.getElementById('loaded_n_total').innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded / event.total) * 100;
		document.getElementById('progressBar').value = Math.round(percent);
		document.getElementById('status').innerHTML = String(Math.round(percent))+"% uploaded... please wait";
	}

	function errorHandler(event){
		document.getElementById('status').value = 'Upload Failed';
	}

	function abortHandler(event){
		document.getElementById('status').value = 'Upload Aborded';
	}

	function upload(file){
		if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
			//xmlHttp.upload.addEventListener("progress", progressHandler, false);
			xmlHttp.addEventListener("load", completeHandler, false);
			xmlHttp.addEventListener("error", errorHandler, false);
			xmlHttp.addEventListener("abort", abortHandler, false);
			xmlHttp.open("POST", "http://192.168.64.2/mvclearn/profile_setup/profile_upload", true); //Creates the request. true is to make the request asynchronous
			//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
			xmlHttp.onreadystatechange = function(){
				uploadHSR(); //call handleServeResponse when the server responses
			}
			xmlHttp.send(file); //sends the request ot the server
		}
		else{
			setTimeout('process()',1000);
		}
	}

	function showProfPicture(image){
		make_base(image, context);
	}

	function uploadHSR(){
		if(xmlHttp.readyState==4){ //if the oibject is done communicating and response is ready
			if(xmlHttp.status==200){ //if communication went ok (so 200 means that communication was successful)
				xmlResponse = xmlHttp.responseXML; //exttracting the xml file from the registerVal.php file
				// alert(xmlHttp.responseText)
				xmlDocumentElement = xmlResponse.documentElement; //root of the xml file
				message = xmlDocumentElement.firstChild.data; //gets the result from the code executed within the response tags
				filename = message;
				showProfPicture(filename)
			}
		}
	}

	//restore image

	window.addEventListener('load', function(){
		restoreImage();
	});

	function restoreImage(){
		if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
			//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
			xmlHttp.open("GET", "http://192.168.64.2/mvclearn/profile_setup/restore_image", true);
			xmlHttp.onreadystatechange = function(){
				restoreImageHSR(); //call handleServeResponse when the server responses
			}
			xmlHttp.send(); //sends the request ot the server
		}
		else{
			setTimeout('process()',1000);
		}
	}

	function restoreImageHSR(){
		if(xmlHttp.readyState==4){ //if the oibject is done communicating and response is ready
			if(xmlHttp.status==200){ //if communication went ok (so 200 means that communication was successful)
				xmlResponse = xmlHttp.responseXML; //exttracting the xml file from the registerVal.php file
				// alert(xmlHttp.responseText)
				xmlDocumentElement = xmlResponse.documentElement; //root of the xml file
				message = xmlDocumentElement.firstChild.data; //gets the result from the code executed within the response tags
				//alert(message)
				//alert(xmlHttp.responseText)
				if(message != "none"){
					filename = message;
					make_base(filename, context);
				}
			}
		}
	}

	//profile picture settings (zoom in zoom out and drag to position)

	document.getElementById('zoom-in').addEventListener('click', function(){
		zoomIn(filename, context, canvas);
	});

	document.getElementById('zoom-out').addEventListener('click', function(){
		zoomOut(filename, context, canvas);
	});

	var imgDir = {
		mouseDragStartX: -1,
		mouseDragStartY: -1,
		imgUpLeftCornerX: 0,
		imgUpLeftCornerY: 0,
	}

	canvas.addEventListener('mousedown', function(e){
		if(imgDir.mouseDragStartX == -1 && imgDir.mouseDragStartY == -1){
			imgDir.mouseDragStartX = e.pageX - canvas.getBoundingClientRect().left - imgDir.imgUpLeftCornerX;
			imgDir.mouseDragStartY = e.pageY - canvas.getBoundingClientRect().top - imgDir.imgUpLeftCornerY;
		}
		canvas.onmousemove = function(e){
			var draggedToX = e.pageX - canvas.getBoundingClientRect().left - imgDir.mouseDragStartX;
			var draggedToY = e.pageY - canvas.getBoundingClientRect().top - imgDir.mouseDragStartY;
			var base_image = new Image();
		    base_image.src = "http://192.168.64.2/mvclearn/storage/images/profile_pics"+filename;
		    base_image.onload = function(){
		    	var widthHeightRatio = this.width/this.height;
		    	// alert(width)
		    	if(height == this.height || height == ""){
		    		height = this.height;
		    	}
		    	width = height*widthHeightRatio;
		    	if(width <= 300){
		    		if(draggedToX <= 0){
		    			draggedToX = 0;
		    		}
		    		else if(draggedToX >= Math.abs(width - 300)){
		    			draggedToX = Math.abs(width - 300);
		    		}
		    	}
		    	else{
		    		if(draggedToX >= 0){
		    			draggedToX = 0;
		    		}
		    		else if(Math.abs(draggedToX) >= Math.abs(width - 300)){
		    			draggedToX = -Math.abs(width - 300);
		    		}
		    	}
		    	if(height <= 300){
		    		if(draggedToY <= 0){
		    			draggedToY = 0;
		    		}
		    		else if(draggedToY >= Math.abs(height - 300)){
		    			draggedToY = Math.abs(height - 300);
		    		}
		    	}
		    	else{
		    		if(draggedToY >= 0){
		    			draggedToY = 0;
		    		}
		    		else if(Math.abs(draggedToY) >= Math.abs(height - 300)){
		    			draggedToY = -Math.abs(height - 300);
		    		}
		    	}
				// document.getElementById('test-debug').innerHTML = " X:"+draggedToX+" Y:"+draggedToY+" width:"+width+" height:"+height+" ";
				imgDir.imgUpLeftCornerX = draggedToX;
				imgDir.imgUpLeftCornerY = draggedToY;
		    	context.imageSmoothingEnabled = false; // turning off anti aliasing
		    	context.imageSmoothingQuality = "high";
		    	context.clearRect(0, 0, canvas.width, canvas.height);
		        context.drawImage(base_image,draggedToX,draggedToY, width, height);
		        // alert(this.width/2+" "+this.height/2+" | "+width+" "+height)
		    }
		}
	});

	canvas.addEventListener('mouseup', function(e){
		canvas.onmousemove = null;
		imgDir.mouseDragStartX = -1;
		imgDir.mouseDragStartY = -1;
	});

	canvas.addEventListener('touchstart', function(e){
		if(imgDir.mouseDragStartX == -1 && imgDir.mouseDragStartY == -1){
			imgDir.mouseDragStartX = e.pageX - canvas.getBoundingClientRect().left - imgDir.imgUpLeftCornerX;
			imgDir.mouseDragStartY = e.pageY - canvas.getBoundingClientRect().top - imgDir.imgUpLeftCornerY;
		}
		canvas.touchmove = function(e){
			context.clearRect(0, 0, canvas.width, canvas.height);
			var draggedToX = e.pageX - canvas.getBoundingClientRect().left - imgDir.mouseDragStartX;
			var draggedToY = e.pageY - canvas.getBoundingClientRect().top - imgDir.mouseDragStartY;
			var base_image = new Image();
		    base_image.src = "http://192.168.64.2/mvclearn/storage/images/profile_pics/"+filename;
		    base_image.onload = function(){
		    	var widthHeightRatio = this.width/this.height;
		    	// alert(width)
		    	if(height == this.height || height == ""){
		    		height = this.height;
		    	}
		    	width = height*widthHeightRatio;
		    	if(width <= 300){
		    		if(draggedToX <= 0){
		    			draggedToX = 0;
		    		}
		    		else if(draggedToX >= Math.abs(width - 300)){
		    			draggedToX = Math.abs(width - 300);
		    		}
		    	}
		    	else{
		    		if(draggedToX >= 0){
		    			draggedToX = 0;
		    		}
		    		else if(Math.abs(draggedToX) >= Math.abs(width - 300)){
		    			draggedToX = -Math.abs(width - 300);
		    		}
		    	}
		    	if(height <= 300){
		    		if(draggedToY <= 0){
		    			draggedToY = 0;
		    		}
		    		else if(draggedToY >= Math.abs(height - 300)){
		    			draggedToY = Math.abs(height - 300);
		    		}
		    	}
		    	else{
		    		if(draggedToY >= 0){
		    			draggedToY = 0;
		    		}
		    		else if(Math.abs(draggedToY) >= Math.abs(height - 300)){
		    			draggedToY = -Math.abs(height - 300);
		    		}
		    	}
				// document.getElementById('test-debug').innerHTML = " X:"+draggedToX+" Y:"+draggedToY+" width:"+width+" height:"+height+" ";
				imgDir.imgUpLeftCornerX = draggedToX;
				imgDir.imgUpLeftCornerY = draggedToY;
		    	context.imageSmoothingEnabled = false; // turning off anti aliasing
		    	context.imageSmoothingQuality = "high";
		        context.drawImage(base_image,draggedToX,draggedToY, width, height);
		        // alert(this.width/2+" "+this.height/2+" | "+width+" "+height)
		    }
		}
	});

	canvas.addEventListener('touchend', function(e){
		canvas.onmousemove = null;
		imgDir.mouseDragStartX = -1;
		imgDir.mouseDragStartY = -1;
	});

	function make_base(image, context){
	    var base_image = new Image();
	    base_image.src = "http://192.168.64.2/mvclearn/storage/images/profile_pics/"+image;
	    base_image.onload = function(){
			var widthHeightRatio = this.width/this.height;
			height = 300;
			width = height*widthHeightRatio;
			context.imageSmoothingEnabled = false; // turning off anti aliasing
			context.imageSmoothingQuality = "high";
	    	context.clearRect(0, 0, canvas.width, canvas.height);
	        context.drawImage(base_image,0,0, width, height);
	    }
	    // document.getElementById('test').src = base_image.src
	}

	function zoomIn(image, context, canvas){
		context.clearRect(0, 0, canvas.width, canvas.height);
	    var base_image = new Image();
	    base_image.src = "http://192.168.64.2/mvclearn/storage/images/profile_pics/"+image;
	    // alert(base_image.src)
	    base_image.onload = function(){
	    	var widthHeightRatio = this.width/this.height;
	    	height = height*1.2;
	    	width = height*widthHeightRatio;
	    	context.imageSmoothingEnabled = false; // turning off anti aliasing
	    	context.imageSmoothingQuality = "high";
	        imgDir.imgUpLeftCornerX = imgDir.imgUpLeftCornerX*1.2;
	        imgDir.imgUpLeftCornerY = imgDir.imgUpLeftCornerY*1.2;
	        var draggedToX = imgDir.imgUpLeftCornerX;
			var draggedToY = imgDir.imgUpLeftCornerY;
	        context.drawImage(base_image, draggedToX, draggedToY, width, height);
	        // alert(this.width/2+" "+this.height/2+" | "+width+" "+height)
	    }
	}

	function zoomOut(image, context, canvas){
		context.clearRect(0, 0, canvas.width, canvas.height);
	    var base_image = new Image();
	    base_image.src = "http://192.168.64.2/mvclearn/storage/images/profile_pics/"+image;
	    // alert(base_image.src)
	    base_image.onload = function(){
	    	var widthHeightRatio = this.width/this.height;
	    	height = height/1.2;
	    	width = height*widthHeightRatio;
	    	context.imageSmoothingEnabled = false; // turning off anti aliasing
	    	context.imageSmoothingQuality = "high";
	        imgDir.imgUpLeftCornerX = imgDir.imgUpLeftCornerX/1.2;
	        imgDir.imgUpLeftCornerY = imgDir.imgUpLeftCornerY/1.2;
	        var draggedToX = imgDir.imgUpLeftCornerX;
			var draggedToY = imgDir.imgUpLeftCornerY;
	        context.drawImage(base_image, draggedToX, draggedToY, width, height);
	        // alert(this.width/2+" "+this.height/2+" | "+width+" "+height)
	    }
	}

	//upload (update) cropped image created in the canvas

	if(document.getElementById('submit-prof') != undefined){
		document.getElementById('submit-prof').addEventListener('click', function(){
			var dataURL = canvas.toDataURL('image/png');
			var postData = "save_changes-1=true&canvasData="+dataURL;
			if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
				//xmlHttp.upload.addEventListener("progress", progressHandler, false);
				xmlHttp.open("POST", "http://192.168.64.2/mvclearn/profile_setup", true); //Creates the request. true is to make the request asynchronous
				//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
				xmlHttp.setRequestHeader('Content-Type', 'canvas/upload');
				xmlHttp.send(postData); //sends the request ot the server
			}
		})
	}
}

//step 2
// if(document.getElementById('save-changes-2') != undefined){
// 	document.getElementById('save-changes-2').addEventListener('click', function(){
// 		var username = document.getElementById('update-username').value;
// 		var location = document.getElementById('location').value;
// 		var about_me = document.getElementById('about_me').value;
// 		var interests = document.getElementById('interests').value;
// 		var main_website = document.getElementById('main_website').value;
// 		// alert(main_website)
// 		if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
// 			//xmlHttp.upload.addEventListener("progress", progressHandler, false);
// 			xmlHttp.open("GET", "http://192.168.64.2/mvclearn/profile_setup/save_changes/step/2/data/"+username+"&location="+location+"&about_me="+about_me+"&interests="+interests+"&main_website="+main_website, true); //Creates the request. true is to make the request asynchronous
// 			//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
// 			//xmlHttp.setRequestHeader('Content-Type', 'canvas/upload');
// 			xmlHttp.onreadystatechange = function(){ //call handleServeResponse when the server responses
// 				if(xmlHttp.readyState==4){ //if the oibject is done communicating and response is ready
// 					if(xmlHttp.status==200){ //if communication went ok (so 200 means that communication was successful)
// 						//alert(xmlHttp.responseText)
// 					}
// 				}
// 			}
// 			xmlHttp.send(); //sends the request ot the server
// 		}
// 	})
// }
//
// if(document.getElementById('save-changes-3') != undefined){
// 	document.getElementById('save-changes-3').addEventListener('click', function(){
// 		var title = document.getElementById('title').options[document.getElementById('title').selectedIndex].value;
// 		var first_name = document.getElementById('first_name').value;
// 		var middle_name = document.getElementById('middle_name').value;
// 		var last_name = document.getElementById('last_name').value;
// 		var gender = document.getElementById('gender').options[document.getElementById('gender').selectedIndex].value;
// 		var birthDate_day = document.getElementById('birthDate_day').options[document.getElementById('birthDate_day').selectedIndex].value;
// 		var birthDate_month = document.getElementById('birthDate_month').options[document.getElementById('birthDate_month').selectedIndex].value;
// 		var birthDate_year = document.getElementById('birthDate_year').options[document.getElementById('birthDate_year').selectedIndex].value;
// 		var email = document.getElementById('email').value;
// 		var cur_password = document.getElementById('cur_password').value;
// 		var new_password = document.getElementById('new_password').value;
// 		var new_conf_password = document.getElementById('new_conf_password').value;
// 		var country_telephone_code = document.getElementById('telephoneNumber_countryCode').options[document.getElementById('telephoneNumber_countryCode').selectedIndex].value;
// 		var phone_number = document.getElementById('phone_number').value;
// 		var address_1 = document.getElementById('address_1').value;
// 		var address_2 = document.getElementById('address_2').value;
// 		var town = document.getElementById('town').value;
// 		var state = document.getElementById('state').value;
// 		var postcode = document.getElementById('postcode').value;
// 		var country = document.getElementById('address_country').options[document.getElementById('address_country').selectedIndex].value;
// 		// alert(main_website)
//
// 		if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
// 			//xmlHttp.upload.addEventListener("progress", progressHandler, false);
// 			xmlHttp.open("GET", url+"/theoneupdate/home/setup_profile_scr.php?save-changes-3=true&title="+title+"&first_name="+first_name+"&middle_name="+middle_name+"&last_name="+last_name+"&gender="+gender+"&birthDate_day="+birthDate_day+"&birthDate_month="+birthDate_month+"&birthDate_year="+birthDate_year+"&email="+email+"&cur_password="+cur_password+"&new_password="+new_password+"&new_conf_password="+new_conf_password+"&country_telephone_code="+country_telephone_code+"&phone_number="+phone_number+"&address_1="+address_1+"&address_2="+address_2+"&town="+town+"&state="+state+"&postcode="+postcode+"&country="+country, true); //Creates the request. true is to make the request asynchronous
// 			//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
// 			//xmlHttp.setRequestHeader('Content-Type', 'canvas/upload');
// 			// xmlHttp.onreadystatechange = function(){ //call handleServeResponse when the server responses
// 			// 	if(xmlHttp.readyState==4){ //if the oibject is done communicating and response is ready
// 			// 		if(xmlHttp.status==200){ //if communication went ok (so 200 means that communication was successful)
// 			// 			//alert(xmlHttp.responseText)
// 			// 		}
// 			// 	}
// 			// }
// 			xmlHttp.send(); //sends the request ot the server
// 		}
// 	})
// }
// 
// if(document.getElementById('done') != undefined){
// 	document.getElementById('done').addEventListener('click', function(){
// 		if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
// 			//xmlHttp.upload.addEventListener("progress", progressHandler, false);
// 			xmlHttp.open("GET", url+"http://192.168.64.2/mvclearn/setup_profile_scr.php?save_changes-4=true", true); //Creates the request. true is to make the request asynchronous
// 			//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
// 			xmlHttp.send(); //sends the request ot the server
// 		}
// 	})
// }

//************* progress bar ****************

// next step

//this variable tracks the step the user currently is. Note that the user may go back to the first step while he has already completed step 3. This variable will be switched to 1.
if(document.getElementsByClassName('setup-all-steps').length != 0){
	var currentStep = Array.prototype.indexOf.call(document.getElementsByClassName('setup-all-steps')[0].children, document.getElementsByClassName('setup-step-current')[0]);
	//this variable tracks the maximum step the user has progressed. Note that this variable only tracks the last step completed by the user, so if the user decides to go back to step 1 from 3, this variable wont update to 1, but remain at 3.
	var maxStep = currentStep;
	var nextButtons = ['step-1-next','step-2-next','step-3-next','done'];
	for(var i = 0; i<nextButtons.length; i++){
		(function(i,nextButtons){ //closure
			document.getElementById(nextButtons[i]).addEventListener('click', function(){
				if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
					//xmlHttp.upload.addEventListener("progress", progressHandler, false);
					xmlHttp.open("GET", url+"/theoneupdate/home/update_step.php?step="+(+i+1), true); //Creates the request. true is to make the request asynchronous
					//the last parameter is set to false in order for the request to be executed sychronously, so avoid different values to be returned from the XML php file. The reg parameter is used to check whether the sign up button is clicked.
					//xmlHttp.setRequestHeader('Content-Type', 'canvas/upload');
					xmlHttp.onreadystatechange = function(){ //call handleServeResponse when the server responses
						if(xmlHttp.readyState==4){ //if the oibject is done communicating and response is ready
							if(xmlHttp.status==200){ //if communication went ok (so 200 means that communication was successful)
								//alert(maxStep+" "+(+i+1))
								if(i+1 < 4 && i == maxStep){
									//alert(xmlHttp.responseText)
									document.getElementsByClassName('setup-step-'+(+i+1))[0].style.display = "none";
									document.getElementsByClassName('step-'+(+i+1))[0].className = 'step-'+(+i+1)+' steps-done'; //changing the second class of this div to 'steps-done' meaning that this step is done
									document.getElementsByClassName('step-'+(+i+1))[0].innerHTML = '<div class="step-bg"><svg class="tick" height="15" width="15" viewBox="0 0 512 512"><path d="m208 433l-164-164 77-78 87 85 196-197 79 78z" stroke="green" stroke-width="5" fill="white"/></path></svg></div>'
									document.getElementsByClassName('setup-step-'+(+i+2))[0].style.display = "block";
									document.getElementsByClassName('step-'+(+i+2))[0].className = 'step-'+(+i+2)+' step-current'; //changing the second class of this div to 'step-current' meaning that this is the current step
									document.getElementsByClassName('step-'+(+i+2))[0].innerHTML = '<div class="step-bg"><svg class="cur" height="15" width="15" viewBox="0 0 512 512"><path d="m479 201c0 10-4 19-11 26l-186 186c-7 7-16 11-26 11c-10 0-19-4-26-11l-186-186c-7-7-11-16-11-26c0-10 4-19 11-26l21-21c8-7 17-11 26-11c11 0 19 4 26 11l139 139l139-139c7-7 15-11 26-11c9 0 18 4 26 11l21 21c7 8 11 16 11 26z" stroke="green" stroke-width="5" fill="white"/></path></svg></div>'
									currentStep = +i+1;
									maxStep = maxStep + 1; //increases the maximum step progressed by the user
								}
								else if(i < maxStep){
									document.getElementsByClassName('setup-step-'+(+i+1))[0].style.display = "none";
									document.getElementsByClassName('setup-step-'+(+i+2))[0].style.display = "block";
									currentStep = +i+1; //updates the current step of the user
								}
							}
						}
					}
					xmlHttp.send(); //sends the request ot the server
				}
			})
		}(i,nextButtons));
	}
}

//making the progress bar labels become clickable and moving the user to a different step depending on the label clicked
if(document.getElementsByClassName('step-label').length != 0){
	var progressBarLabels = document.getElementsByClassName('step-label');
	for(var i = 0; i<progressBarLabels.length; i++){
		(function(i,labels){ //closure
			labels[i].addEventListener('click', function(){
				if(maxStep >= i){
					document.getElementsByClassName('setup-all-steps')[0].children[currentStep].style.display = "none";
					document.getElementsByClassName('setup-all-steps')[0].children[i].style.display = "block";
					currentStep = i;
				}
			})
		}(i,progressBarLabels));
	}
}
