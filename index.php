<?php include("functions.php"); ?>
<html>
<head>
	<title>MQTT MOSQUITTO PHP </title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<br>
	<div class="container-fluid">
		 <div class="page-header text-center">
  			<h1>Raspberry Pi | Mosquitto Broker  <small>With PHP 7.0</small></h1>
		 </div>
		<div class="row">
			<div class="col-sm-4">

			</div>
			<div class="col-sm-4 text-center">
				<form action="http://172.20.10.2/mosquitto/index.php" method="post">
				 <input class="hidden form-control" type="text" name="btn1" value="PUBLISH">
				 <input class=" hidden btn btn-primary" type="submit" name="btn2" value="SUBSCRIBE">
 				</form> 
			</div>
			<div class="col-sm-4">
	
			</div>
		</div>

		<?php
    
    // Global variables
		$statusmsg = "";
		$rcv_message = ""; 

		if (1==1)
			{
					
			$statusmsg = " ";	
			$rcv_message = " ";
			
			if (function_exists('read_topic')) {
   				 read_topic('PUBTOPIC', 'localhost', 1883, 60, 5);	// Reading messages by the client.

			} 
			
      // Display of the message corresponding to the image captured by the camera of the raspberry.
			if(!empty($rcv_message) )
				{
				?>
					<div class="row">
					 
					<div class="col-sm-4">
						<b>Cam 1</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam1">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	 ?>
						</div>	
					</div>
					<div class="col-sm-4">
						<b>Cam 2</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam2">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	
									 
							 ?>
						</div>
					</div>
					<div class="col-sm-4">
						<b>Cam 3</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam3">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	 ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<b>Cam 4</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam1">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	 ?>
						</div>	
					</div>
					<div class="col-sm-4">
						<b>Cam 5</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam2">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	 ?>
						</div>
					</div>
					<div class="col-sm-4">
						<b>Cam 6</b>
						<div class="well">
							<img src=<?php echo "http://172.20.10.2/mosquitto/images/".$rcv_message ." " ?> alt="Cam3">
							<?php echo $statusmsg."RCVD|" . $rcv_message ;	 ?>
						</div>
					</div>
				</div>

			<?php
		
				}
			else
				{
				echo $statusmsg."TIMEDOUT"; 	
				}		
			}

		?>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		
		$(function(){
		setInterval(function(){
		    $.ajax({
			url:'index.php',
			success:function(data){
			    if(data == "index.php"){
			    }else{
				$('html').html(data);
			}
			}
		    });
		},4000);
		});

	</script>
</body>
</html>
