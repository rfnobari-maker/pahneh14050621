<?php
$options = array(
"login" => "nezam",
"password" => "nezam1352"
);
$client = new SoapClient("http://sms.hostiran.net/webservice/?WSDL", $options);
try
{
$messageId = $client->send("٠٩١٢١١١١١١١", "تست پیام کوتاه!");
sleep(٣);
print ($client->deliveryStatus($messageId));
var_dump($client->accountInfo());
}
catch (SoapFault $sf)
{
print $sf->faultcode.”\n”;
print $sf->faultstring.”\n”;
}

?>