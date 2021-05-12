<?php
function getAllCategory($id)
{
	$CI =& get_instance();
	$CI->load->model('category/category_model');

	$r = $CI->category_model->getAllCategory();
	echo "<option value='0'>-Select Category-</option>";
	if(count($r))
	{
		for($i=0;$i<count($r);$i++)
		{
			?>
<option value='<?php echo $r[$i]->id?>'
			<?php if(isset($id) && $id!='' && $id==$r[$i]->id){ echo "selected"; } ?>><?php echo $r[$i]->name;?></option>
			<?php
		}
	}

}


function get_all_courses()
{
	$CI =& get_instance();
	$CI->load->model('home/home_model');
	$category = $CI->home_model->get_all_categories();
	if(count($category))
	{
		for($i=0;$i<count($category);$i++)
		{
			?>
<li><a href="<?php echo base_url();?>home/category/<?php echo $category[$i]->id;?>"><?php echo $category[$i]->name;?></a>
<ul class="sub-dropdown">
<?php
$sub_category = $CI->home_model->get_all_subcategories($category[$i]->id);
if(count($sub_category))
{
	for($j=0;$j<count($sub_category);$j++)
	{
		?>
	<li><a href="#"><?php echo $sub_category[$j]->name;?></a>
	<ul class="sub-menu">
	<?php
	$sub_sub_category = $CI->home_model->get_all_subsubcategories($sub_category[$j]->id);
	if(count($sub_sub_category))
	{
		for($k=0;$k<count($sub_sub_category);$k++)
		{
			?>
		<li><a href=""><?php echo $sub_sub_category[$k]->name; ?></a></li>
		<?php
		}
	}
	?>
	</ul>
	</li>
	<?php
	}
}?>
</ul>
</li>
<?php
		}
	}

}
function display_content($page)
{
	$CI = & get_instance();
	$CI->load->model('home/home_model');

	$r = $CI->home_model->getContent($page);
	echo substr($r[0]->description,0,150);
}
function recent_posts()
{
	$CI = & get_instance();
	$CI->load->model('home/home_model');

	$r = $CI->home_model->getRecentPosts();
	if(count($r))
	{
		for($i = 0; $i < count($r); $i++)
		{
		?>
		<li><i class="fa fa-star-o "></i> <a href="#"><?php echo substr($r[$i]->title,0,70);?></a></li>
		<?php
		} 
	}
}
function get_testimonials()
{
	$CI = & get_instance();
	$CI->load->model('home/home_model');

	$r = $CI->home_model->getRecentTestimonials();
	if(count($r))
	{
		for($i = 0; $i < count($r); $i++)
		{
		?>
		<p><?php echo substr($r[$i]->message,0,150);?><br/>
          <span><?php echo $r[$i]->name.", ".$r[$i]->city;?></span><br/>
          <a href="<?php echo base_url();?>">Read More</a> </p>
		<?php
		} 
	}
}


function getVendors($id)
{
	$CI = & get_instance();
	$CI->load->model('user/user_model');

	$r = $CI->user_model->getVendors();
	echo "<option value='0'>-Select Vendor-</option>";
	if (count($r)) {
		for ($i = 0; $i < count($r); $i++) {
			?>
<option value='<?php echo $r[$i]->id ?>'
<?php if (isset($id) && $id != '' && $id == $r[$i]->id) {
	echo "selected";
} ?>><?php echo $r[$i]->display_name; ?></option>
<?php
		}
	}
}

function getAllSubCategory($id)
{
	$CI = & get_instance();
	$CI->load->model('siteadmin/category_model');

	$r = $CI->category_model->getAllSubCategory();
	echo "<option value='0'>-Select Sub Category-</option>";
	if (count($r)) {
		for ($i = 0; $i < count($r); $i++) {
			?>
<option value='<?php echo $r[$i]->id ?>'
<?php if (isset($id) && $id != '' && $id == $r[$i]->id) {
	echo "selected";
} ?>><?php echo $r[$i]->name; ?></option>
<?php
		}
	}
}

function getAllSubSubCategory($id)
{
	$CI = & get_instance();
	$CI->load->model('category/category_model');

	$r = $CI->category_model->getsub_subcategory();
	echo "<option value='0'>-Select Category-</option>";
	if (count($r)) {
		for ($i = 0; $i < count($r); $i++) {
			?>
<option value='<?php echo $r[$i]->id ?>'
<?php if (isset($id) && $id != '' && $id == $r[$i]->id) {
	echo "selected";
} ?>><?php echo $r[$i]->name; ?></option>
<?php
		}
	}
}
// function to get a particular vendor type


function getAllBLOGS($id)
{
	$CI =& get_instance();
	$CI->load->model('blog/blog_model');

	$r = $CI->blog_model->getAllBLOGS();
	echo "<option value='0'>-Select Blog-</option>";
	if(count($r))
	{
		for($i=0;$i<count($r);$i++)
		{
			?>
<option value='<?php echo $r[$i]->id;?>'
			<?php if(isset($id) && $id!='' && $id==$r[$i]->id){ echo "selected"; } ?>><?php echo $r[$i]->name;?></option>
			<?php
		}
	}

}


function allcoursecategory()
{
	$CI = & get_instance();
	$CI->load->model('course/course_registration_model');
	$r = $CI->course_registration_model->allcoursecategories();
	echo "<option value='#'>---Select Category----</option>";
	if (count($r))
	{
		for ($i = 0; $i < count($r); $i++)
		{
			?>
<option value='<?php echo $r[$i]->id ?>'
<?php
if (isset($id) && $id != '' && $id == $r[$i]->id)
{
	echo "selected";
}
?>><?php echo $r[$i]->name; ?></option>
<?php
		}
	}
}

function allcoursecategorybyid($id)
{
	$CI = & get_instance();
	$CI->load->model('course/course_registration_model');
	$r = $CI->course_registration_model->allcoursecategories();
	echo "<option value='#'>---Select Category----</option>";
	if (count($r))
	{
		for ($i = 0; $i < count($r); $i++)
		{
			?>
<option value='<?php echo $r[$i]->id ?>'
<?php
if (isset($id) && $id != '' && $id == $r[$i]->id)
{
	echo "selected";
}
?>><?php echo $r[$i]->name; ?></option>
<?php
		}
	}
}

function LoadFolders($parent_id)
{
	$CI = & get_instance();   
	// $result = $CI->db->query("SELECT file_id, file_name FROM employer_files WHERE folder_id = '".$parent_id."' ORDER BY file_name");
	// $files_result = $result->result();
	// if($files_result && count($files_result) > 0)
	// {	
	// 	echo "<ol>";	
	// 	for($k = 0 ; $k < count($files_result) ; $k++)
	// 	{
 //      		$file_id = $files_result[$k]->file_id;
 //      		$file_name = $files_result[$k]->file_name;

	//         echo '<li class="file"><a href="#">'.$file_name.'</a></li>';  
 //      	} 

 //      	$result = $CI->db->query("SELECT folder_id, folder_name FROM employer_folder WHERE parent_id = '".$parent_id."' ORDER BY folder_name");
	// 	$subfolder_result = $result->result();
	// 	if($subfolder_result)
	// 	{
	// 		echo "<li>";
	//       	for($j = 0 ; $j < count($subfolder_result) ; $j++)
	//       	{
	//       		$folder_id = $subfolder_result[$j]->folder_id;
	//       		$folder_name = $subfolder_result[$j]->folder_name;
	// 	        echo '<li><label for="folder'.$folder_id.'">'.$folder_name.'</label><input type="checkbox" id="folder'.$folder_id.'" />'; 
	// 	        LoadFolders($folder_id);
	//         	echo '</li>';	       
	//       	}
	//       	echo "</li>";
	// 	}
 //      	echo "</ol>";     	
	// }
	// else
	// {
	// 	$result = $CI->db->query("SELECT folder_id, folder_name FROM employer_folder WHERE parent_id = '".$parent_id."' ORDER BY folder_name");
	// 	$subfolder_result = $result->result();
	// 	if($subfolder_result && count($subfolder_result) > 0)
	// 	{
	// 		echo "<ol>";	
	// 		echo "<li>";
	//       	for($j = 0 ; $j < count($subfolder_result) ; $j++)
	//       	{
	//       		$folder_id = $subfolder_result[$j]->folder_id;
	//       		$folder_name = $subfolder_result[$j]->folder_name;
	// 	        echo '<li><label for="folder'.$folder_id.'">'.$folder_name.'</label><input type="checkbox" id="folder'.$folder_id.'" />'; 
	// 	        LoadFolders($folder_id);
	//         	echo '</li>';	       
	//       	}
	//       	echo "</li>";
	//       	echo "</ol>";    
	// 	}
	// }
	/*end files*/
	$result = $CI->db->query("SELECT folder_id, folder_name FROM employer_folder WHERE parent_id = '".$parent_id."' ORDER BY folder_name");
	$subfolder_result = $result->result();
	if($subfolder_result)
	{
		echo "<ol>";
      	for($j = 0 ; $j < count($subfolder_result) ; $j++)
      	{
      		$folder_id = $subfolder_result[$j]->folder_id;
      		$folder_name = $subfolder_result[$j]->folder_name;
	        echo '<li><label for="folder'.$folder_id.'">'.$folder_name.'</label><input type="checkbox" id="folder'.$folder_id.'" />'; 
	        LoadFolders($folder_id);
        	echo '</li>';	       
      	}
      	echo "</ol>";
	}
}

?>