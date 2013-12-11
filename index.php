<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<link rel="stylesheet" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "<?php echo WEBSOCKET_URI;?>"; 	
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		console.log('Connected');
	} 
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data 
		console.log(msg);
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		if(type=='usermsg' && umsg!=null){
			var msgcount = parseInt($('#notification_count').text()) + parseInt('1');
			$('#notification').append('<li id="msg_'+msgcount+'">'+umsg+'</li>');
			$('#notification_count').text(msgcount);
			$('#notification_count').show();
		}
	};
	
	websocket.onerror	= function(ev){console.log('Error - '+ev.data);}; 
	websocket.onclose 	= function(ev){console.log('Connection closed');}; 
	
	if($('#notification_count').text()=='0'){
		$('#notification_count').hide();
	} 
	
	$('#msgs').click(function(){
		if($('#notification_count').text()!='0'){
			$('#notification').slideToggle('slow');
		} 
	});
	
});
</script>
</head>
<body>
 <section class="container">
    <nav>
      <ul>
        <li>
			<a href="javascript:;" id="msgs">Messages<span class="badge green" id="notification_count">0</span></a>
			<ul id="notification">
			</ul>
        </li>
      </ul>
    </nav>
  </section>

</body>
</html>
