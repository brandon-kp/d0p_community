<?php
function imgur_upload($filename, $api_key, $method='json', $title='', $caption='')
{
	$handle = fopen($filename, "r");
	$data = file_get_contents($filename);
	
	$pvars = array(
	'image' => base64_encode($data),
	'key' => $api_key,
	'title' => $title,
	'caption' => $caption,
	);
	$timeout = 30;
	$curl = curl_init();
	
	if($method=='json')
	{
	curl_setopt($curl, CURLOPT_URL, 'http://api.imgur.com/2/upload.json');
	}
	elseif($method=='xml')
	{
	curl_setopt($curl, CURLOPT_URL, 'http://api.imgur.com/2/upload.xml');
	}
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
	
	$json = curl_exec($curl);
	
	curl_close ($curl);
	
	return $json;
}