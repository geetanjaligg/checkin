<?php

if(isset($_GET['code'])){
	$code = $_GET['code'];

	$ch = curl_init();

	$url = 'https://foursquare.com/oauth2/access_token?client_id=033MKCPSDFMK3UWLNLX215BWJJXLNQQMVCC2BLNZHN5F4IJL&client_secret=RHVXD2HYJR2QNERA0PKPI3L1XJVL1MLKTKDTPT5304XI1ZM5&grant_type=authorization_code&redirect_uri=http://localhost/heroku/checkins.php&code=' . $code;
								//echo $url;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	curl_close($ch);
	$arr = json_decode($contents,true);
	echo $arr['access_token'];

	if(!empty($arr['access_token'])){

		$ch = curl_init();

	$url = 'https://api.foursquare.com/v2/users/self/checkins?oauth_token=' . $arr['access_token'] . '&v=20140922';
								//echo $url;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec($ch);
	curl_close($ch);
	print_r($contents);
	$checkins = json_decode($contents,true);
	print_r($checkins);
	}


}

?>