<?php 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.defprogramming.com/random/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36");
$contents = curl_exec($ch);

preg_match('/(?<=jumbotron"><p>).+?(?=<)/', $contents, $quote);
preg_match('/(?<=author-name">).+?(?=<)/', $contents, $author);	

$quote = $quote[0].' -'.$author[0];
$quote = str_split($quote, 140);

include('way2sms.php');
$client = new WAY2SMSClient();
$client->login('YOUR_LOGIN_MOBILE_NUMBER', 'PASSWORD');
foreach ($quote as $sms) {
	$client->send('MOBILE_NUMBER_TO_SEND_QUOTE', $sms);
	sleep(5);
}
$client->logout();