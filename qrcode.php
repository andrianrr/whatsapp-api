
<?php
$data = [
    'full' 	=> '', 
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$token = 'c53xoj5mpif55frh';
$instanceId = '380281';
$url = 'https://api.chat-api.com/instance'.$instanceId.'/status?token='.$token;
// Make a POST request
$options = stream_context_create(['http' => [
	'method'  => 'GET',
	'header'  => 'Content-type: application/json',
	'content' => $json
]
]);
// Send a request

$result = file_get_contents($url, false, $options);
$response = json_decode($result, true);

?>
<img width="300px" src="<?php echo $response['qrCode']?>">




