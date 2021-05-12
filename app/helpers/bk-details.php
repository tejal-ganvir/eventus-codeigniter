<body onLoad="MM_preloadImages('<?php echo theme_url();?>images/hover-img.png','<?php echo theme_url();?>images/manage-icon-3-hover.png','<?php echo theme_url();?>images/manage-icon-4-hover.png','<?php echo theme_url();?>images/manage-icon-5-hover.png')">
<script type="text/javascript" src="<?php echo theme_url();?>js/jquery.min.js"></script>

<div class="css">

	<div class="main">
    
    	    	  <?php   $this->load->view('frontend/menu'); ?>

            
  <!--********************menu close**********************-->
 
  <!--********************center start**********************-->
  
<div id="center">

<div class="center-img-main"> 



<div class="image-main">

	
<div class="real-main"><span class="txt-color">Real</span> Wedding</div>


<div class="detail-txt">

<?php echo $real_weddings[0]->description; ?>
</div>


<div class="detail-main">

	<div class="banner">
    <?php if($real_weddings[0]->banner != '')
	{ 
	?>
    	<img src="<?php echo base_url().'uploads/'.$real_weddings[0]->banner; ?>" height="256" width="1027" />
    <?php
	}
	?>
    </div>
    
    <div class="detail-img">
    
    	<div class="detail-img-1">
    <?php if($real_weddings[0]->left_image != '')
	{ 
	?>
    	<img src="<?php echo base_url().'uploads/'.$real_weddings[0]->left_image; ?>" height="267" width="312" />
    <?php
	}
	?>
        
        </div>
        
        <div class="detail-img-2">
        
        	<div class="detail-2-a">
            
            	<!--<img src="images/real-wedding-images/logo-real.jpg" />-->
                <div style="width:267px; text-align:center; padding-top: 25px;">
                <?php 
				 echo strtoupper($real_weddings[0]->bride_name);
				?>	
                <hr width="80%">
                <?php 
				echo strtoupper($real_weddings[0]->groom_first_name); ?>
                <br>
                <?php echo strtoupper($real_weddings[0]->groom_surname); ?>
                 <br>
                 <br>
                <?php echo $real_weddings[0]->city.', '.$real_weddings[0]->country; ?>
                 </div>
            </div>
            
            <div class="detail-2-b">
            
        <img src="<?php echo theme_url();?>images/real-wedding-images/like-button.jpg" align="absmiddle" class="mr" />256 &nbsp; &nbsp;| &nbsp; &nbsp; <img src="<?php echo theme_url();?>images/share.jpg" align="absmiddle" class="mr" />256
            
            </div>
        
        </div>
        
        <div class="detail-img-3">
        
    <?php if($real_weddings[0]->right_image != '')
	{ 
	?>
    	<img src="<?php echo base_url().'uploads/'.$real_weddings[0]->right_image; ?>" height="267" width="312" />
    <?php
	}
	?>
        
        </div>
    
    </div>
 
 
 <?php 
// echo count($images);
$i=0;
$k=0;
 foreach($images as $image)
 {
	 if($k%4==0)
	 { $start = '<div class="dis-img-2">'; $end = '';}
	 else if($k%4 == 3)
	 { $start = ''; $end = '';}
	 else
	 { $start = ''; $end = '';}
	
	echo $start;

$class = 'image_1_hover';

?>	



<div class="image_1_hover dis-img-2-a <?php if($i%4 != 0) {?> ml20 <?php } ?>">

<style>
#cboxOverlay{ background:#666666; }
</style>

		<a id="frameimg_<?php echo $i; ?>" href="javascript:return void(0);" class="facybox" onClick="TINY.box.show({iframe:'<?php echo base_url();?>home/image/<?php echo $images[$i]->id; ?>',boxid:'frameless',width:1014, height:600, fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})">
    	
		
		<img src="<?php echo base_url().'uploads/'.$image->filename;?>" style="width:225px;" /></a>

        <div class="trans-real">
        	<div class="trans-1 width200">
            	<a href="#" onClick="loveImage(<?php echo $images[$i]->id;?>)"><img src="<?php echo theme_url(); ?>images/pin-1.png" align="absmiddle" class="mr" /></a><span id='<?php echo "love_".$images[$i]->id ;?>'><?php echo get_imageLove($images[$i]->id) ;?>Loves</span>
            </div>
            <div class="trans-2">
            	<a class="clicker">Stick<img src="<?php echo theme_url();?>images/pin-2.png" align="absmiddle" id="frame_<?php echo $i; ?>" href="javascript:return void(0);" class="facybox" onClick="TINY.box.show({iframe:'<?php echo base_url();?>vendors/stick/<?php echo $images[$i]->id; ?>',boxid:'frameless',width:300, height:200,left:450, top: 300, fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})" /></a>
            </div>
        </div>
    </div>



<!-- 
<div class="dis-img-2-a <?php if($k%4 != 0) {?>  <?php } ?>" style='margin-right:100px;'>
<style>
#cboxOverlay{ background:#666666; }
</style>
<a id="frameimg_<?php echo $i; ?>" href="javascript:return void(0);" class="facybox" onClick="TINY.box.show({iframe:'<?php echo base_url();?>home/image/<?php echo $images[$i]->id; ?>',boxid:'frameless',width:1014, height:600, fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})"><img src="<?php echo base_url().'uploads/'.$images[$i]->filename; ?>" style="max-width:329px;min-width:329px;margin-top:10px;" /></a>

<div class="trans">
<div class="trans-1"> <a href="#" onClick="loveImage(<?php echo $images[$i]->id;?>)"><img src="<?php echo theme_url(); ?>images/pin-1.png" align="absmiddle" class="mr" /></a><span id='<?php echo "love_".$images[$i]->id ;?>'><?php echo get_imageLove($images[$i]->id) ;?>Loves</span></div>
<div class="trans-2">
  <div class="click-nav">
	<ul class="no-js">
	  <li>   <a class="clicker">Stick<img src="<?php echo theme_url();?>images/pin-2.png" align="absmiddle" id="frame_<?php echo $i; ?>" href="javascript:return void(0);" class="facybox" onClick="TINY.box.show({iframe:'<?php echo base_url();?>vendors/stick/<?php echo $images[$i]->id; ?>',boxid:'frameless',width:300, height:200,left:450, top: 300, fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}})" /></a>

	 
	
	  </li>
	</ul>
  </div>
</div>
</div>
</div>
-->




<?php	 
$i++;
$k+=3;
}
 ?>
<!--   
<div class="dis-img-2">

	<div class="dis-img-2-a">
    
    	<img src="images/real-wedding-images/image-3.jpg" />
        
        <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
   
    </div>

<div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-4.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-5.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-6.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>

</div>    

<div class="dis-img-2">

	<div class="dis-img-2-a">
    
    	<img src="images/real-wedding-images/image-3.jpg" />
        
        <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
   
    </div>

<div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-4.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-5.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-6.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>

</div>

<div class="dis-img-2">

	<div class="dis-img-2-a">
    
    	<img src="images/real-wedding-images/image-3.jpg" />
        
        <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
   
    </div>

<div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-4.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-5.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>
    
    <div class="dis-img-2-a ml20">
    
    	<img src="images/real-wedding-images/image-6.jpg" />
    
    <div class="trans-real">
        
        	<div class="trans-1 width200">
            
            	<img src="images/pin-1.png" align="absmiddle" class="mr" />999 Loves
            
            </div>
            
            <div class="trans-2">
            
            	Stick it<img src="images/pin-2.png" align="absmiddle" class="ml" />
            
            </div>
        
        </div>
    
    </div>

</div>    
-->

</div>
<div class="see-txt">


<img src="<?php echo theme_url(); ?>images/real-wedding-images/drop-arrow.jpg" align="absmiddle" class="mr" />See More Photos</div>

<div class="see-main">

	<div class="see-1">
    
    	<div class="see-1-a">
        <?php
		if($real_weddings[0]->photographer != '')
		{
			?>
        	<img src="<?php echo vendor_icon_url(); ?>icon-1.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->photographer);?>
        <?php
		} 
		?>
        </div>
        
        <div class="see-1-a">
        <?php
		if($real_weddings[0]->beauty != '')
		{
			?>
        
        	<img src="<?php echo vendor_icon_url(); ?>icon-5.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->beauty);?>
<?php } ?>        
        </div>
    
    <div class="see-1-a">
                <?php
		if($real_weddings[0]->bridal != '')
		{
			?>

        	<img src="<?php echo vendor_icon_url(); ?>icon-3.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->bridal);?>
        <?php } ?>
        </div>
    
    </div>
    
    <div class="see-1">
    
    	<div class="see-1-a">
                <?php
		if($real_weddings[0]->groom_clothing != '')
		{
			?>

        	<img src="<?php echo vendor_icon_url(); ?>icon-6.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->groom_clothing);?>
        <?php } ?>
        </div>
        
        <div class="see-1-a">
                <?php
		if($real_weddings[0]->decor != '')
		{
			?>

        	<img src="<?php echo vendor_icon_url(); ?>icon-2.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->decor);?>
        <?php } ?>
        </div>
    
    <div class="see-1-a">
                <?php
		if($real_weddings[0]->decor != '')
		{
			?>
        	<img src="<?php echo vendor_icon_url(); ?>icon-8.jpg" align="absmiddle" class="mr" /> <?php echo get_vendorById($real_weddings[0]->caterer);?>
        <?php } ?>
        </div>
    
    </div>
    
</div>

<div class="creat">

	Create & Share Your Dream Wedding<img src="<?php echo theme_url();?>images/real-wedding-images/button.jpg" align="absmiddle" class="ml20" />

</div>









</div>



</div>


</div>
  <!--********************center close**********************-->


  <script type="text/javascript">
function loveImage(id)
{
	//alert('hi');
	$.post('<?php echo base_url().'vendors/loveImage/';?>',{id:id},function(data)
	{
		
		//$('#image_mesg').html(data);
		
		//var love = $('#love_'+id).val();
		//alert(data)
		
		$('#love_'+id).html(data);
		/*
		if(data > 0)
		{

			//$('#love_'+id).val(data+ 'Loves');
		}
		else if(data=="2")
		{
			alert('dsfdsfds');
			//$('#love_'+id).val('Already sent');
		}
		else
		{
			//$('#love_'+id).val('Already sent');
		}
		*/


	});	 
}

</script>
            
    