  <style type="text/css">

#myslider {
  position: relative;
  overflow: hidden;
  margin: 0 auto;
  border-radius: 4px;
}

#myslider ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 200px;
  list-style: none;
}

#myslider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 500px;
  height: 300px;
  background: #ccc;
  text-align: center;
  line-height: 200px;
}

#myslider ul li img{
  width: 100%;
    max-height: 100%;
  }

a.control_prev, a.control_next {
  position: absolute;
  top: 40%;
  z-index: 1;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  display: none;
  border-radius: 0 2px 2px 0;
}

a.control_next {
  display: none;
  right: 0;
  border-radius: 2px 0 0 2px;
}

.mywidget{
    text-align:left;
    color:#000;
    padding-right: 100px;
}

@media screen and (max-width: 500px) {


  .mywidget{
    text-align:left;
    color:#000;
    padding-right: 0px;
}

#myslider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 250px;
  height: 150px;
  background: #ccc;
  text-align: center;
  line-height: 100px;
}

#myslider ul li img{
  width: 100%;
  }
 
}

 </style>

    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-header">
                        <h1 style="font-size: 42px;font-weight: bolder;">Thank You!</h1>
                        <p>We have received your booking request</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- content left -->
                    <div class="row">
                        <div class="col-md-12 post-holder">
                            <div class="well-box">
                              <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td colspan="2">
                                        <div id="myslider">
                                          <a href="#" class="control_next">></a>
                                          <a href="#" class="control_prev"><</a>
                                          <ul>
                                            <?php 
                                              if($service_image)
                                              {
                                                for ($k=0; $k < count($service_image); $k++) 
                                                {  
                                            ?>
                                            <li><img  src="<?php echo base_url();?>uploads/service_image/<?php echo $service_image[$k]->name; ?>" class="img-fluid" alt=""/> </li>
                                            <?php 
                                                }
                                              }
                                            ?>
                                          </ul>  
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Service Provider</th>
                                      <td><?php echo $service_detail['company']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Hosted By</th>
                                      <td><?php echo $service_detail['fname']." ".$service_detail['lname']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Service Name</th>
                                      <td><?php echo $booked_service['service_name']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Package Name</th>
                                      <td><?php echo $booked_service['package_name']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Number Of Guest</th>
                                      <td>
                                        <?php
                                        if ($booked_service['guest_id'] == 1) {
                                            echo "0-100 Guests";
                                          }elseif ($booked_service['guest_id'] == 2) {
                                            echo "100-200 Guests";
                                          }elseif ($booked_service['guest_id'] == 3) {
                                            echo "200-300 Guests";
                                          }elseif ($booked_service['guest_id'] == 4) {
                                            echo "300-400 Guests";
                                          }elseif ($booked_service['guest_id'] == 5) {
                                            echo "400-500 Guests";
                                          }elseif ($booked_service['guest_id'] == 6) {
                                            echo "500&Up Guests";
                                          }
                                         ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Start Date</th>
                                      <td><?php echo $booked_service['startdate']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Start Time</th>
                                      <td><?php echo $booked_service['start_time']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>End Date</th>
                                      <td><?php echo $booked_service['enddate']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>End Time</th>
                                      <td><?php echo $booked_service['end_time']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Amount</th>
                                      <td><?php echo "₹ ".$booked_service['amount']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Status</th>
                                      <td>
                                        <span style="color:#fa0f2d;font-weight: bolder;">In Review</span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center">
                                        <button class="btn btn-default" style="margin: 0 10px;" onclick="window.history.go(-1); return false;">Back</button>
                                      </td>
                                    </tr>
                                      
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

    setInterval(function () {
        moveRight();
    }, 3000);
  

  
  var slideCount = $('#myslider ul li').length;
  var slideWidth = $('#myslider ul li').width();
  var slideHeight = $('#myslider ul li').height();
  var mysliderUlWidth = slideCount * slideWidth;
  
  $('#myslider').css({ width: slideWidth, height: slideHeight });
  
  $('#myslider ul').css({ width: mysliderUlWidth, marginLeft: - slideWidth });
  
    $('#myslider ul li:last-child').prependTo('#myslider ul');

    function moveLeft() {
        $('#myslider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#myslider ul li:last-child').prependTo('#myslider ul');
            $('#myslider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#myslider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#myslider ul li:first-child').appendTo('#myslider ul');
            $('#myslider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });


     $("#myslider").mouseenter(function(){
        $('a.control_next,a.control_prev').fadeIn(1000,function(){
            $('#myslider').mouseleave(function(){
                $('a.control_next,a.control_prev').fadeOut(1000);
            });
        });
    });

});    

  </script>
