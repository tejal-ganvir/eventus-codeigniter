    <div class="tp-dashboard-head">
        <!-- page header -->
        <?php
            if($this->session->userdata('profile_image')){
            $CustPhoto = $this->session->userdata('profile_image')?'uploads/profile_pic/'.$this->session->userdata('profile_image'):"themes/frontend/images/no-image.png";
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 profile-header">
                    <div class="profile-pic col-md-2 col-xs-4"><img src="<?php echo base_url().$CustPhoto;?>" alt="" class="img-responsive img-circle"></div>
                    <div class="profile-info col-md-9 ">
                        <h1 class="profile-title"><?php echo $this->session->userdata('fname');?><small>Welcome Back</small></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page header -->
    <div class="tp-dashboard-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 dashboard-nav">
                    <ul class="nav nav-pills nav-justified">
                        <li class="<?php if(isset($menu)){ if($menu == 'account'){ echo "active"; }}?>"><a href="<?php echo base_url() ?>home/myaccount"><i class="fa fa-user db-icon"></i>Account</a></li>
                        <li class="<?php if(isset($menu)){ if($menu == 'space'){ echo "active"; }}?>"><a href="<?php echo base_url() ?>home/spacelist"><i class="fa fa-dashboard db-icon"></i>Space</a></li>
                        <li class="<?php if(isset($menu)){ if($menu == 'service'){ echo "active"; }}?>"><a href="<?php echo base_url() ?>home/servicelist"><i class="fa fa-list db-icon"></i>Service </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>