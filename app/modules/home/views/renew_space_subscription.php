

    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-header">
                        <h1 style="font-size: 52px;font-weight: bolder;">Renew Space Subscription</h1>
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
                              <?php 
                                if($this->session->flashdata('success'))
                                  {
                                    echo '<div class="alert alert-success errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
                                  } 
                                elseif($this->session->flashdata('error'))
                                  {
                                    echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'</div>';
                                  }
                              ?>
                              <p><span style="color: red; font-weight: bolder;">* Note : </span> <b>Renewal of Your Space will be extended from your date of expiry, Only if your package is not expired.</b></p>
                              <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <th>Space Name</th>
                                      <td><?php echo $subscribed_space['title']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Venue Type</th>
                                      <td><?php echo $subscribed_space['venue_name']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Number Of Guest</th>
                                      <td>
                                        <?php
                                        if ($subscribed_space['guest'] == 1) {
                                            echo "0-100 Guests";
                                          }elseif ($subscribed_space['guest'] == 2) {
                                            echo "100-200 Guests";
                                          }elseif ($subscribed_space['guest'] == 3) {
                                            echo "200-300 Guests";
                                          }elseif ($subscribed_space['guest'] == 4) {
                                            echo "300-400 Guests";
                                          }elseif ($subscribed_space['guest'] == 5) {
                                            echo "400-500 Guests";
                                          }elseif ($subscribed_space['guest'] == 6) {
                                            echo "500&Up Guests";
                                          }
                                         ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Plan Type</th>
                                      <td>
                                        <?php
                                          if ($subscribed_space['plan_id'] == 1) {
                                            echo "Yearly Plan";
                                          }else{
                                            echo "Half Yearly Plan";
                                          }
                                        ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Subscribed On</th>
                                      <td><?php echo date("d F Y", strtotime($subscribed_space['starts_on'])); ?></td>
                                    </tr>
                                    <tr>
                                      <th>Expire's On</th>
                                      <td><?php echo date("d F Y", strtotime($subscribed_space['ends_on'])); ?></td>
                                    </tr>
                                    <tr>
                                      <th>Amount</th>
                                      <td><?php echo "₹ ".$subscribed_space['amount']; ?></td>
                                    </tr>
                                    <!-- <tr>
                                      <th>Total Paid</th>
                                      <td><?php if($subscribed_space['renew_amount'] == '0'){
                                            echo "₹ ".$subscribed_space['amount'];
                                          }else{
                                             echo "₹ ".$subscribed_space['renew_amount'];
                                          }
                                      ?></td>
                                    </tr> -->
                                    <tr>
                                      <td colspan="2" class="text-center">
                                        <form id="my_form" action="<?php echo base_url(); ?>home/space_renewal" method="post">
                                          <input type="hidden" name="status" value="<?php echo $subscribed_space['is_paid'];?>">
                                          <input type="hidden" name="subscription_id" value="<?php echo $subscribed_space['subscription_id'];?>">
                                          <input type="hidden" name="plan_id" value="<?php echo $subscribed_space['plan_id'];?>">
                                          <input type="hidden" name="starts_on" value="<?php echo $subscribed_space['starts_on'];?>">
                                          <input type="hidden" name="ends_on" value="<?php echo $subscribed_space['ends_on'];?>">
                                          <input type="hidden" name="amount" value="<?php echo $subscribed_space['amount'];?>">
                                          <input type="hidden" name="renew_amount" value="<?php echo $subscribed_space['renew_amount'];?>">
                                          <input type="hidden" name="unique_id" value="<?php echo $unique_id;?>">
                                        </form>
                                        <button class="btn btn-warning completed" id="renew" style="margin: 5px;">Renew Space</button>
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
  $('#renew').on('click', function(){
    $.confirm({
        title: 'Confirmation Message',
        content: 'Lets Renew Your Package!!',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        icon: 'fa fa-refresh',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () { 
            $('#my_form').submit();
          }
      });
  });
</script>

