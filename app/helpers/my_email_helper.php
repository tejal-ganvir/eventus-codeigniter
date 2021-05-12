<?php

function send_mail($name,$to,$type,$otherfield='')
{

$CI =& get_instance();

$CI->load->library('email');

$config['mailtype'] ='html';
$CI->email->initialize($config);

$CI->email->from('info@wedmegood.com',$CI->config->item('site_name'));
$CI->email->to($to); 

/*
$mailHeader = '<table width="600" border="0" cellpadding="0" cellspacing="0">
				<tr>
						<td  style="padding: 10px 20px 10px 10px; background-color:#CB2A17;">
							<img src="'.theme_url().'images/logo.jpg" alt="'.$CI->config->item('site_name').'" title="'.$CI->config->item('site_name').'" style="border: 5px solid #fff;">
						</td>
				</tr>
';
*/
$mailHeader = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="700" border="0" cellspacing="0" cellpadding="5" style="font-family:Arial, Helvetica, sans-serif">
    <tr>
    <td colspan="2" align="center" style="border:4px solid #CB2A17; border-bottom:none;">
       <a href="#"><img src="'.theme_url().'images/top-logo.png" alt="Wed me Good" style="width:100px;"/></a>
     
    </td>
  </tr>';

$mailFooter = ' <tr><td colspan="2" style="font-size:12px; border:4px solid #CB2A17; border-top:none; border-bottom:none;"><strong>Regards,</strong></td>
  </tr><tr><td colspan="2" style="font-size:12px; border:4px solid #CB2A17; border-top:none; border-bottom:none;">'.$CI->config->item('site_name').'</td>
  </tr><tr><td colspan="2">&nbsp;</td></tr><tr bgcolor="#333333"><td colspan="2"><span style="font-size:10px; color:#fff; float:left; text-align:left;">&copy; 2013 '.$CI->config->item('site_name').' | All Rights Reserved</span>
      </td></tr></table></body></html>';

switch($type)
	{

		case 'activation_mail': $subject = 'Account Activation mail from '.$CI->config->item('site_name');
							 $msg     = '<tr> 
												<td style="padding:10px; border:4px solid #CB2A17; border-bottom:none; border-top:none;">
													Hi '.ucfirst($name).' <br><br>
													Welcome to '.$CI->config->item('site_name').'. Thank you for registering on our webiste. Please click the below link to verify your email address. <br><br>
													<a href="'.base_url().'user/verify/'.base64_encode($to).'/'.base64_encode($otherfield).'/" target="_blank">Verify Your Account</a>
													<br>
													<br>
																																
													Please feel free to contact us for any queries.			

												</td>
										</tr>';	
										break;
		case 'Contact_Reply': $subject = $CI->input->post('subject');
							 $msg     = '<tr> 
												<td style="padding:10px; border:4px solid #CB2A17; border-bottom:none;">
													'.$CI->input->post('subject').'	

												</td>
										</tr>';	
										break;
										
										
  case 'foget': $subject = 'Wed Me Good: Reset Password';
						$msg     = '<tr>   
    <td valign="top" colspan="2" align="justify" style="padding:10px; border:4px solid #CB2A17; border-bottom:none; border-top:none;">Hi <strong>'.$name.'</strong> <br><br>
												. <br><br>
												<br>
												We have addressed your page claim request and your page is now linked to your email id.					
												Your New Password Is:- '.$otherfield.'
												<br>.</td></tr>';	
									

									break;

case 'fbregister': $subject = 'Welcome to Wed Me Good:';
		
		$msg     = '<tr>
		<td valign="top" colspan="2" align="justify" style="padding:10px; border:4px solid #CB2A17; border-bottom:none; border-top:none;">Dear '.ucfirst($name).',
		<br>
		Thank you for registering with <a href="'.base_url().'" target="_blank">wedmegood.com</a>
		<br>
		Should you require further assistance, please contact us at  <a href="mailto:info@wedmegood.com" target="_blank"> help@wedmegood.com</a>
		<br>
		Your New Password Is:- '.$otherfield.'
		<br>
		Yours sincerely,<br>
		 <a href="'.base_url().'" target="_blank">wedmegood.com</a>
		</td></tr>';	

break;


  case 'grant': $subject = 'Wed Me Good: Your Profile Page';
						$msg     = ' <tr>
   
    <td valign="top" colspan="2" align="justify" style="padding:10px; border:4px solid #CB2A17; border-bottom:none; border-top:none;">Hi <strong>'.$to.'</strong> <br><br>
												. <br><br>
												<br>
												We have addressed your page claim request and your page is now linked to your email id. 
												
												Your Username is :- '.$to.'
												Your New Password Is:- WMGVENDOR
												<br>.</td></tr>';	
									
									break;

	}

$message = $mailHeader.$msg.$mailFooter;


$CI->email->subject($subject);
$CI->email->message($message);	
$CI->email->send();

//$CI->email->print_debugger();
//echo $message;
}