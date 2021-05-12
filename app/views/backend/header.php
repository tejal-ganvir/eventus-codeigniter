<!DOCTYPE html>
<html lang="en" class="loading">
  
<head>
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#237e8d">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#237e8d">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#237e8d">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Settle :: Dashboard</title>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/apple-icon-60.html">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/apple-icon-76.html">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/apple-icon-120.html">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/apple-icon-152.html">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/favicon.png">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>themes/backend/app-assets/img/ico/favicon.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/vendors/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/<?php echo base_url();?>themes/backend/app-assets/vendors/css/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/vendors/css/chartist.min.css">
    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/backend/app-assets/vendors/css/sweetalert2.min.css">
    <!-- END APEX CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- BEGIN Page Level CSS-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
  </head>
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <div data-active-color="white" data-background-color="purple-bliss" data-image="<?php echo base_url();?>themes/backend/app-assets/img/sidebar-bg/01.jpg" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="<?php echo base_url();?>siteadmin/dasboard" class="logo-text float-left">
              <div class="logo-img"><img src="<?php echo base_url();?>themes/backend/app-assets/img/logo.png" height="40" width="40"/></div><span class="text align-middle">ettle</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-toggle-right toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
              <li class="nav-item <?php if(isset($menu))if($menu == 'dashboard'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/dasboard"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
              </li>
              <li class="nav-item <?php if(isset($menu))if($menu == 'edit'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/edit_profile"><i class="ft-user"></i><span data-i18n="" class="menu-title">Admin Profile</span></a>
              </li>
              <li class="nav-item <?php if(isset($menu))if($menu == 'create'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/create_profile"><i class="ft-user-plus"></i><span data-i18n="" class="menu-title">Create Profile</span></a>
              </li>
              <li class="has-sub "><a href="#"><i class="ft-map-pin"></i><span data-i18n="" class="menu-title">Locations</span></a>
                <ul class="menu-content">
                  <li class="<?php if(isset($menu))if($menu == 'country'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/timeslot/add_country" class="menu-item">Add Country</a>
                  </li>
                  <li class="<?php if(isset($menu))if($menu == 'state'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/timeslot/add_state" class="menu-item">Add State</a>
                  </li>
                  <li class="<?php if(isset($menu))if($menu == 'city'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/timeslot/add_city" class="menu-item">Add City</a>
                  </li>
                </ul>
              </li>
              <li class="has-sub nav-item"><a href="#"><i class="ft-aperture"></i><span data-i18n="" class="menu-title">Masters</span></a>
                <ul class="menu-content">
                  <li class="<?php if(isset($menu))if($menu == 'service'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/master/services" class="menu-item">Service Type</a>
                  </li>
                  <li class="<?php if(isset($menu))if($menu == 'venue'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/master/venue" class="menu-item">Venue Type</a>
                  </li>
                  <li class="<?php if(isset($menu))if($menu == 'event'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/master/events" class="menu-item">Events</a>
                  </li>
                  <li class="<?php if(isset($menu))if($menu == 'testimonial'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/master/add_testimonial" class="menu-item">Testimonials</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item <?php if(isset($menu))if($menu == 'spacelist'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/space/space_list"><i class="ft-grid"></i><span data-i18n="" class="menu-title">Spaces List</span></a>
              </li>
              <li class="nav-item <?php if(isset($menu))if($menu == 'servicelist'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/service/service_list"><i class="ft-align-justify"></i><span data-i18n="" class="menu-title">Services List</span></a>
              </li>
              <li class="nav-item <?php if(isset($menu))if($menu == 'bookedspace'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/space/booked_space_list"><i class="ft-check-square"></i><span data-i18n="" class="menu-title">Booked Spaces</span></a>
              </li>
              <li class=" nav-item <?php if(isset($menu))if($menu == 'bookedservice'){ echo 'active'; }?>"><a href="<?php echo base_url();?>siteadmin/service/booked_service_list"><i class="ft-check-circle"></i><span data-i18n="" class="menu-title">Booked Services</span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>
      <!-- / main menu-->

      <div class="main-panel">

        <!-- Navbar (Header) Starts-->

        <nav class="navbar navbar-expand-lg navbar-light bg-faded">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              <form role="search" class="navbar-form navbar-right mt-1">
                <div class="position-relative has-icon-right">
                  <h3>Welcome Admin</h3>
                </div>
              </form>
            </div>
            <div class="navbar-container">
              <div id="navbarSupportedContent" class="collapse navbar-collapse" style="display: block;">
                <ul class="navbar-nav">
                  <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-settings font-medium-3 blue-grey darken-4"></i>
                      <p class="d-none">Settings</p></a>
                    <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right"><a href="<?php echo base_url();?>siteadmin/edit_profile" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>Edit Profile</span></a>
                      <div class="dropdown-divider"></div><a href="<?php echo base_url();?>siteadmin/logout" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
        <!-- Navbar (Header) Ends-->

        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->