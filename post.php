<?php
$args = [
	'f_name' => FILTER_SANITIZE_STRING, 
	'l_name' => FILTER_SANITIZE_STRING, 
	'active' => FILTER_SANITIZE_STRING, 
	'amount' => FILTER_SANITIZE_STRING, 
	'action' => FILTER_SANITIZE_STRING
];

$method = $_SERVER['REQUEST_METHOD'];
$get = filter_input_array(INPUT_GET, $args);
$post = filter_input_array(INPUT_POST, $args);
$put = NULL;
$delete = NULL;

switch ($method)
{
	case 'GET':
		echo doGet($get);
	case 'POST':
		echo doPost($post);
	case 'PUT':
		echo doPut($put);
	case 'DELETE':
		echo doDelete($delete);
	default:
		echo onBadRequest();
}

function doPost($post)
{
	if (validate($post) == true)
	{
		if($post['action'] == 'process_donation')
			$donationResult = processDonation($post);
			if (!empty($donationResult))
			{
				http_response_code(200);
				return $donationResult;
			}
	}
	http_response_code(500);
	return false;
}

function doPut($put)
{
	http_response_code(405);
	return false;
}
function doDelete($delete)
{
	http_response_code(405);
	return false;
}
function doGet($get)
{
	http_response_code(405);
	return false;
}

function onBadRequest()
{
	http_response_code(500);
	return false;
}

function validate($data)
{
	if (array_key_exists('f_name', $data) && !empty($data['f_name']) &&
	 	array_key_exists('l_name', $data) && !empty($data['l_name']) &&
	 	array_key_exists('active', $data) && !empty($data['active']) &&
	 	array_key_exists('amount', $data) && !empty($data['amount']) &&
	 	array_key_exists('action', $data) && !empty($data['action'])) 
		return true;
}

function processDonation($data)
{
	return json_encode(
						array(
								"Message" => "Donation Successful"
						)
					);
}
?>
