<?php
  /**
 * Created by PhpStorm.
 * User: Odilon Hema
 * Date: 26/12/2017
 * Time: 10:57
 */
	 
    /**
     * Method for sending messages through the MQTT.
     * @param $msg
     * @param $topic
     * @param $server
     * @param $port
     * @param $keepalive
     */
		function publish_message($msg, $topic, $server, $port, $keepalive) {
			$client = new Mosquitto\Client();
			$client->onConnect('connect');
			$client->onDisconnect('disconnect');
			$client->onPublish('publish');
			$client->connect($server, $port, $keepalive);
	
			try {
				$client->loop();
 				$mid = $client->publish($topic, $msg);
				
				}catch(Mosquitto\Exception $e){
						echo 'Exception';          
						return;
					}
		     $client->disconnect();
		    unset($client);					    
		}

		// Call back functions required for publish function
		function connect($r) {
				if($r == 0) echo "{$r}-CONX-OK|";
				if($r == 1) echo "{$r}-Connection refused (unacceptable protocol version)|";
				if($r == 2) echo "{$r}-Connection refused (identifier rejected)|";
				if($r == 3) echo "{$r}-Connection refused (broker unavailable )|";        
		}
		 
		function publish() {
			global $client;
			echo "Message published:";
		}
		 
		function disconnect() {
			echo "Disconnected|";
		}
		
     
    /**
     * Method for receiving messages through the MQTT.
     * @param $topic
     * @param $server
     * @param $port
     * @param $keepalive
     * @param $timeout
     */
		function read_topic($topic, $server, $port, $keepalive, $timeout) {
				
					$client = new Mosquitto\Client();
					$client->onConnect('connect');
					$client->onDisconnect('disconnect');
					$client->onSubscribe('subscribe');
					$client->onMessage('message');
					$client->connect($server, $port, $keepalive);
					$client->subscribe($topic, 1);
		

					if (function_exists('publish_message')) {


					$image_name = time()."_"."cam.jpg"; // Creating a unique name for the image received.
				 
					shell_exec(' sudo -s'); // executing of shell CLI
          
		      
          // Acquisition of the image by the raspberry using the shell.

					shell_exec("/usr/bin/raspistill -t 2000 -q 100 -br 50 -co 20 -sa 20 -mm average -sh 10 -w 380 -h 200 -n -o /var/www/html/mosquitto/images/".$image_name);
					
          
          publish_message($image_name, 'PUBTOPIC', 'localhost', 1883, 5);	
          sleep(2); 
					} 
	
					$date1 = time();
					$GLOBALS['rcv_message'] = '';
					while (true) {
							$client->loop();
							sleep(1);
							$date2 = time();
							if (($date2 - $date1) > $timeout) break;
							if(!empty($GLOBALS['rcv_message'])) break;
					}
					 
					$client->disconnect();
					unset($client);						
				} 

				//Additional callback functions required for subscribe
				function subscribe() {
						       //**Store the status to a global variable - debug purposes
						$GLOBALS['statusmsg'] = $GLOBALS['statusmsg'] . "SUB-OK|";
				}

				function message($message) {
						       //**Store the status to a global variable  - debug purposes
						$GLOBALS['statusmsg']  = "RX-OK|";

						       //**Store the received message to a global variable
						$GLOBALS['rcv_message'] =  $message->payload; 
				}

				function logger() {
					var_dump(func_get_args());
				}
		?>

