<?php

function send_mail($name,$to,$type,$otherfield)
{

$CI =& get_instance();

$CI->load->library('email');

$config['mailtype'] ='html';
$CI->email->initialize($config);

$CI->email->from('info@crowdparti.com',$CI->config->item('site_name'));
$CI->email->to($to); 


$mailHeader = '<table width="600" border="0" cellpadding="0" cellspacing="0">
				<tr>
						<td  style="padding: 10px 20px 10px 10px; background-color:#CB2A17;">
							<img src="'.theme_url().'images/logo.jpg" alt="'.$CI->config->item('site_name').'" title="'.$CI->config->item('site_name').'" style="border: 5px solid #fff;">
						</td>
				</tr>
';
$mailFooter = '<tr><td style="padding:10px; border:4px solid #CB2A17; border-top:none;"><strong>Best Regards</strong><br><br>'.$CI->config->item('site_name').' team</td></tr>
<tr style="background-color:#CB2A17; color: #fff;">
					<td style="padding: 10px 20px;">
							Copyright '.$CI->config->item('site_name').' 
					</td>
					</tr>
</table>';


switch($type)
	{

		case 'Contact': $subject = 'Thank you for submitting your Inquiry';
							 $msg     = '<tr> 
												<td style="padding:10px; border:4px solid #CB2A17; border-bottom:none;">
													Hi '.ucfirst($name).' <br><br>
													Thank you for submitting your inquiry. We have received the inquiry details. Our team will get back to you soon. <br><br>
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
										
										
  case 'foget': $subject = 'Reset password renovation';
						 $msg     = '<tr> 
											<td style="padding:10px; border:4px solid #CB2A17; border-bottom:none;">
												'.ucfirst($name).' <br><br>
												. <br><br>
												<br>
												Your New Password Is:-'.$otherfield.'
												<br>.<a herf="'.base_url().'user/login">Renovation Login</a>

											</td>
									</tr>';	
									break;

	}

$message = $mailHeader.$msg.$mailFooter;


$CI->email->subject($subject);
$CI->email->message($message);	
$CI->email->send();

echo $CI->email->print_debugger();
//echo $message;
}