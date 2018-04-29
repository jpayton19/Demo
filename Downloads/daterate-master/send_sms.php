<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'ACb9abb42445272046af17f0b0e06eaa3b';
$auth_token = '26e677f252eda3a4d1bd64b9167a98f0';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
$twilio_number = "+16154923887";
$destination_number = "+18582439712"//$_POST['phone'];
$client = new Client($account_sid, $auth_token);
function guid(){
    if(function_exists('com_create_guid')){
        return com_create_quid();
    }
    else{
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = chr(123).substr($charid,0,8).$hyphen.substr($charid,8,4).$hyphen.substr($charid,12,4).$hyphen.substr($charid,16,4).$hyphen.substr($charid,20,12).chr(125);
        return $uuid;
    }
}
$tmp = guid();
$client->messages->create(
    // Where to send a text message (your cell phone?)
    $destination_number,
    array(
        'from' => $twilio_number,
        'body' => "http://ec2-18-221-125-140.us-east-2.compute.amazonaws.com/testDateRate/rating-page.html?"+$tmp;
    )
);

/*
$token = sha1(uniqid($user, true));
$query = $db->prepare(
"INSERT INTO users(user, token, tstamp) VALUES (?,?,?)");
$query->execute(
    array(
        $user,
        $token,
        $_SERVER["REQUEST_TIME"]));

if(isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])){
    $token = $GET["token"];
}
else{
    throw new Exception("Valid token not found.");
}

$query = $db->prepare("SELECT username, tstamp FROM ratings WHERE token = ?");
$query->execute(array($token));
$row = $query->fetch(PDO::FETCH_ASSOC);
$query->clostCursor();

if($row) {
    extract($row);
}
else{
    throw new Exception("Valid token not found.");
}
//do one-time action here

$url = "http://daterate.com/send_sms.php?token=$token";*/
?>