<div class="row match-height">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header text-center pb-0">
                <span class="font-medium-2 primary">Space Count</span>
                <h3 class="font-large-2 mt-1"><?php echo $space_count?></h3>
            </div>
            <div class="card-body">
                <div id="donut-chart1" class="height-250 donut1">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header text-center pb-0">
                <span class="font-medium-2 warning">Service Count</span>
                <h3 class="font-large-2 mt-1"><?php echo $service_count?></h3>
            </div>
            <div class="card-body">
                <div id="donut-chart2" class="height-250 donut2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header text-center pb-0">
                <span class="font-medium-2 danger">Users</span>
                <h3 class="font-large-2 mt-1"><?php echo count($users)?></h3>
            </div>
            <div class="card-body">
                <div id="donut-chart3" class="height-250 donut3">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scroll - vertical, dynamic height table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Is Verified</th>
                                    <th>Registered On</th>
                                    <th>Block</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                              if($users)
                                {
                                for ($i=0; $i < count($users) ; $i++) 
                                {  
                                ?>  
                                <tr id="row<?php echo $users[$i]->user_id?>">
                                    <td><?php echo $users[$i]->user_id?></td>
                                    <td><?php echo $users[$i]->fname." ".$users[$i]->lname?></td>
                                    <td><?php echo $users[$i]->email_id?></td>
                                    <td><?php echo $users[$i]->mobileno?></td>
                                    <td>
                                        <?php
                                        if($users[$i]->is_idconfirm == 1){
                                            echo "Verified";
                                        }else{
                                            echo "Not Verified";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $users[$i]->created_on?></td>

                                    <?php if($users[$i]->is_deleted == 1){
                                        $text = 'Unblock';
                                        $clased = 'block-us';
                                    }else{
                                        $text = 'Block';
                                        $clased = '';
                                    }?>

                                    <td><button class="btn btn-raised gradient-purple-bliss white btn-block <?php echo $clased?>" data-id="<?php echo $users[$i]->user_id?>"><?php echo $text?></button></td>
                                    <td><button class="btn btn-raised gradient-pomegranate white btn-block btn_delete" dataa-id="<?php echo $users[$i]->user_id?>">Delete</button></td>
                                </tr>
                                <?php }
                                    }

                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Scroll - vertical, dynamic height table -->
<script src="<?php echo base_url();?>themes/backend/app-assets/js/dashboard2.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(".btn-block").on('click',function(){
        var id = $(this).attr('data-id');
        //alert(id);
            if($(this).hasClass('block-us')){
                swal({
                    title: 'Are you sure?',
                    text: "You want to unblock this user!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: "No, cancel"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/block_user", data: { id:id,type: 'unblock'},
                              success: function(result) {
                                result = parseInt(result);
                                if(result > 0) {
                                  $("[data-id="+result+"]").text('Block');
                                  $("[data-id="+result+"]").removeClass('block-us');
                                }
                              }

                             });
                        swal(
                            'Unblocked!',
                            'User is successfully unblocked!!',
                            'success'
                        );
                    }
                }).catch(swal.noop);

            }else{
                swal({
                    title: 'Are you sure?',
                    text: "You want to block this user!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: "No, cancel"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/block_user", data: { id:id,type: 'block'},
                              success: function(result) {
                                result = parseInt(result);
                                if(result > 0) {
                                  $("[data-id="+result+"]").text('Unblock');
                                  $("[data-id="+result+"]").addClass('block-us');
                                }
                              }

                             });
                        swal(
                            'Blocked!',
                            'User is successfully blocked!!',
                            'success'
                        );
                    }
                }).catch(swal.noop);
            }
    });


    $(".btn_delete").on('click',function(){
        var id = $(this).attr('dataa-id');
        swal({
                    title: 'Are you sure?',
                    text: "You want to Delete this user, This cant be undone!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: "No, cancel"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/delete_user", data: { id:id,type: 'unblock'},
                              success: function(result) {
                                result = parseInt(result);
                                if(result > 0) {
                                  $("#row"+result).hide('slow');
                                }
                              }

                             });
                        swal(
                            'Deleted!',
                            'User is successfully deleted!!',
                            'success'
                        );
                    }
                }).catch(swal.noop);
    });
</script>