function closeOverlay(){
  document.getElementById('overlay').className = 'hidden';
  document.getElementById('overlay_shadow').className = 'hidden';
}

function showOverlay(){
  document.getElementById('overlay').className = 'visible';
  document.getElementById('overlay_shadow').className = 'visible';
}

function writeOverlay(message){
	document.getElementById('message').innerHTML=message;
	showOverlay();
}