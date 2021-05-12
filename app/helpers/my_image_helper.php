<?php

function get_contractor_image($contractor_id)
{
	$CI =& get_instance();
	$CI->load->model('contractor/contractor_model');
	
	$r = $CI->contractor_model->get_image($contractor_id);
	return $r;
}

function get_review_user($user_id)
{
	$CI =& get_instance();
	$CI->load->model('buyer/buyer_model');
	
	$r = $CI->buyer_model->get_buyer_by_id($user_id);
	return $r;
}

?>