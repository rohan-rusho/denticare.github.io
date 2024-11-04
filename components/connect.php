<?php 
	
	$db_name = 'mysql:host=localhost;dbname=dental_db';
	$user_name = 'root';
	$user_password = '';

	$conn = new PDO($db_name, $user_name, $user_password);

	if(!$conn){
		echo "not connected";

	}

	function unique_id(){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charLength = strLen($chars);
		$randomString = '';
		for ($i=0; $i < 20; $i++){
			$randomString.=$chars[mt_rand(0, $charLength - 1)];
		}
		return $randomString;

	}

?>