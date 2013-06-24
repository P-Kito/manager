<?php
	
	function myHandler($code, $msg, $file, $line) {
		global $log_file;
	    $logData = date("d-M-Y h:i:s", time()) . ", $code, $msg, $line, $file\n";
	    @file_put_contents($log_file, $logData, FILE_APPEND);
	}
	if(file_exists($log_file)==true){
		set_error_handler('myHandler');
		/**
		 *  Fehler in einer Datei protokollieren
		 */
	} else {
		echo 'No Log File existing.';
		exit;
	}
?>