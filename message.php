<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
.chat_wrapper {
	width: 500px;
	margin-right: auto;
	margin-left: auto;
	background: #CCCCCC;
	border: 1px solid #999999;
	padding: 10px;
	font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .panel input{
	padding: 2px 2px 2px 5px;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> 
<script language="javascript" type="text/javascript">  
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "<?php echo WEBSOCKET_URI;?>"; 		
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		console.log('Connected');
	}

	$('#send-btn').click(function(){ //use clicks message send button	
		var mymessage = $('#message').val(); //get message text  
		
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}
		
		//prepare json data
		var msg = {
		message: mymessage
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	});
	
	websocket.onerror	= function(ev){console.log('Error - '+ev.data);}; 
	websocket.onclose 	= function(ev){console.log('Connection closed');}; 
});
</script>
</head>
<body>	
<div class="chat_wrapper">
<div class="panel">
<input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
<button id="send-btn">Send</button>
</div>
</div>

</body>
</html>
