<?php
function sms($number,$text)
{
	$options = array(
'login' => 'nezam',
'password' => 'nezam1352'
);
$client = new SoapClient('http://sms.hostiran.net/webservice/?WSDL', $options);
try
{
	$messageId = $client->send($number, $text);
	sleep(3);
	}
catch (SoapFault $sf)
{
}
}
?>