<?php

// Enable error reporting to help us debug issues
error_reporting(E_ALL);

// Start PHP sessions
session_start();

require_once('./config.php');

#$oToken = json_decode(file_get_contents(APP_URL . 'token.php?key=' . $_GET['key']));

#define('APP_TOKEN', $oToken->token);

function doPost($sMethod, $aPost = array())
{
	// Build the request string we are going to POST to the API server. We include some of the required params.
	$sPost = 'token=' . APP_TOKEN . '&method=' . $sMethod;
	foreach ($aPost as $sKey => $sValue)
	{
		$sPost .= '&' . $sKey . '=' . $sValue;
	}		
		
	// Start curl request.
	$hCurl = curl_init();		
		
	curl_setopt($hCurl, CURLOPT_URL, APP_URL . 'api.php');
	curl_setopt($hCurl, CURLOPT_HEADER, false);
	curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, true);			

	curl_setopt($hCurl, CURLOPT_SSL_VERIFYPEER, false);
			
	curl_setopt($hCurl, CURLOPT_POST, true);
	curl_setopt($hCurl, CURLOPT_POSTFIELDS, $sPost);
		
	// Run the exec
	$sData = curl_exec($hCurl);
			
	// Close the curl connection
	curl_close($hCurl);	
	
	// print(APP_URL . 'api.php?' . $sPost);

	// Return the curl request and since we use JSON we decode it.
	return json_decode(trim($sData));		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
	<head>
		<title>НАЗВАНИЕ_ПРИЛОЖЕНИЯ</title>		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>static/style.php?app_id=<?php echo APP_ID; ?>" />
		<script type="text/javascript">
			$(document).ready(function(){				
				$('body').append('<iframe id="crossdomain_frame" src="<?php echo APP_URL; ?>static/crossdomain.php?height=' + document.body.scrollHeight + '&nocache=' + Math.random() + '" height="0" width="0" frameborder="0"></iframe>');
			});		
		</script>
	</head>
	<body>
	
<div class="mobile">
        <iframe width="100%" height="750" scrolling="no" style="position:absolute;left:0px;top:0px;z-index:0;" src="https://НАЗВАНИЕ_САЙТА" frameborder="0"></iframe>
      </div>


	</body>
</html>