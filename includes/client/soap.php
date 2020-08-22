<?php

require 'vendor/autoload.php';

// Config
if($rosseta['uri'] != '') {
	$client = new nusoap_client($rosseta['uri'], true);
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = FALSE;

	$params = array(
		'param0' => [
			'api_key' => $rosseta['token'],
			'user_id' => $rosseta['user_id'],
			'group_id' => $rosseta['group_id'],
			'first_name' => $rosseta['first_name'],
			'last_name' => $rosseta['last_name'],
			'email' => $rosseta['email'],
			'language' => $rosseta['language'],
			'language_level' => $rosseta['language_level'],
			'dry_run' => $rosseta['dry_run'],
			'password' => $rosseta['password'],
			'curriculum' => $rosseta['curriculum'],
			'localization' => $rosseta['localization']
		]);
	// Calls
	$result = $client->call('CreateLearner', $params);
	$file = file_get_contents("./rossetalog/createlearner".preg_replace('/[^0-9]/', '',$_POST['billing_cpf']).$now.".txt");
	file_put_contents("./rossetalog/createlearner".preg_replace('/[^0-9]/', '',$_POST['billing_cpf']).$now.".txt",$file . "\n\n" .serialize($client));

	for($i = 1;$i <= count($level);$i++){
		$params = array(
			'param0' => [
				'api_key' => $rosseta['token'],
				'user_id' => $rosseta['user_id'],
				'group_id' => $rosseta['group_id'],
				'first_name' => $rosseta['first_name'],
				'last_name' => $rosseta['last_name'],
				'email' => $rosseta['email'],
				'language' => $rosseta['language'],
				'language_level' => $level[$i],
				'dry_run' => $rosseta['dry_run'],
				'password' => $rosseta['password'],
				'curriculum' => $rosseta['curriculum'],
				'localization' => $rosseta['localization']
			]);

		$result = $client->call('UpdateLearner', $params);
		$file = file_get_contents("./rossetalog/createlearner".preg_replace('/[^0-9]/', '',$_POST['billing_cpf']).$now.".txt");
		file_put_contents("./rossetalog/createlearner".preg_replace('/[^0-9]/', '',$_POST['billing_cpf']).$now.".txt",$file . "\n\n" .serialize($client));
	}
}


