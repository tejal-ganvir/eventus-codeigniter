<?php

function theme_url()
{
	return base_url().'themes/frontend/';
}

function backend_theme_url()
{
	return base_url().'themes/backend/';
}
function buyer_image()
{
	return base_url().'public/buyer_image/';
}

function admin_url()
{
	return base_url().'themes/admin/';
}


function vendor_image_url()
{
	return base_url().'uploads/';
}

function vendor_icon_url()
{
	return base_url().'uploads/vendor_types/';
}


function upload_url()
{
	return base_url().'uploads/';
}


function facebook_url()
{



	require 'facebook_sdk/facebook.php';
	$facebook = new Facebook(array(
	  'appId'  => '372259426240005',
	  'secret' => '993fd314613e8add53358d74735cac06',
	));

	$params = array( 'scope'=>'email, manage_pages');

$loginUrl = $facebook->getLoginUrl($params);

return $loginUrl;



/*echo $_SERVER['QUERY_STRING'];
if($_SERVER['REQUEST_URI'] == '/fb/')
	{
		$comp = '';
	}
else
	{
		$comp = '../../';
	}

	
$_SERVER['REQUEST_URI'];

$CI =& get_instance();

$CI->load->library('session');

$loginUrl = $logoutUrl = '';
	
	require $comp.'facebook_sdk/facebook.php';

	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '372259426240005',
	  'secret' => '993fd314613e8add53358d74735cac06',
	));

	$params = array( 'scope'=>'email, manage_pages');
	$user = $facebook->getUser();


	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user = $facebook->api('me');
		//print_r($user);
		$user_profile = $facebook->api('/me/accounts/');

		  $logoutUrl = $facebook->getLogoutUrl();
$data = array(
		
		'logoutUrl' => $logoutUrl,
		'name' => $user['name'],
		'email' => $user['email']
	
	);

$CI->session->set_userdata($data);

	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	else
	{ 
  		$loginUrl = $facebook->getLoginUrl($params);
	}

return $loginUrl;
*/
}

?>