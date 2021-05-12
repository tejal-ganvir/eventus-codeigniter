<?php $this->load->view('frontend/topmenu'); ?> 
<style type="text/css">
.vendor-img img{
  max-width: 100%;
  height: 350px;
}
embed {
    -webkit-overflow-scrolling: touch;
    width: 100%;
  overflow-y: scroll;
    height: 350px;
}
</style>
<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li class="active"><a href="<?php echo base_url();?>home/servicelist">Listing Services</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofservice">List My Service</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites_services">Favourite Services</a></li>
                            <li><a href="<?php echo base_url();?>home/service_request">Service Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 content-right profile-dashboard">
                    <?php 
                      if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
                        {
                          echo '<div class="alert alert-success errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('message').'</div>';
                        } 
                      elseif($this->session->flashdata('message1')!="" && $this->session->flashdata('message1')!=null)
                        {
                          echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('message1').'</div>';
                        }
                    ?>
                    <form id="service_form" method="POST" action="<?php echo base_url();?>home/kyc_ofservice" enctype="multipart/form-data">
                      <div class="col-md-6">
                          <div class="vendor-list-block mb30">
                              <!-- vendor list block -->
                              <div class="vendor-img">
                                  <div id="viewer">
                                    <?php 
                                      if (!empty($documents['id_proof'])) {
                                      ?>
                                      <embed src="<?php echo base_url();?>uploads/service_documents/<?php echo $documents['id_proof'] ?>" >
                                      <?php }else{ ?>
                                      <img src="<?php echo base_url();?>themes/frontend/images/preview.jpg" id="pre_img">
                                    <?php } ?>
                                  </div>
                                  <div class="category-badge">
                                    <input type="file" name="id_proof" id="id_proof" value="<?php if($documents){ echo $documents['id_proof']; }?>" my-data="<?php if($documents){ echo $documents['id_proof']; }?>">
                                  </div>
                              </div>
                              <div class="vendor-detail">
                                  <!-- vendor details -->
                                  <div class="caption">
                                      <h2><font color="red">*</font> Provider's Identity Proof</h2>
                                      <div class="vendor-meta"> 
                                        <span id="valid_id" style="color: red;"> </span> 
                                      </div>
                                  </div>
                              </div>
                              <!-- /.vendor details -->
                          </div>
                          <!-- /.vendor list block -->
                      </div>
                      <div class="col-md-6">
                          <div class="vendor-list-block mb30">
                              <!-- vendor list block -->
                              <div class="vendor-img">
                                  <div id="pdfviewer">
                                    <?php 
                                      if (!empty($documents['service_proof'])) {
                                    ?>
                                      <embed src="<?php echo base_url();?>uploads/service_documents/<?php echo $documents['service_proof'] ?>" >
                                      <?php }else{ ?>
                                      <img src="<?php echo base_url();?>themes/frontend/images/preview.jpg" id="pre_spcimg">
                                    <?php } ?>
                                  </div>
                                  <div class="category-badge">
                                    <input type="file" name="service_proof" id="service_proof" value="<?php if($documents){ echo $documents['service_proof']; }?>" my-data="<?php if($documents){ echo $documents['service_proof']; }?>">
                                  </div>
                              </div>
                              <div class="vendor-detail">
                                  <!-- vendor details -->
                                  <div class="caption">
                                      <h2><font color="red">*</font> Service Proof:</h2>
                                      <div class="vendor-meta"> 
                                        <span id="valid_spc" style="color: red;"> </span> 
                                      </div>
                                  </div>
                              </div>
                              <!-- /.vendor details -->
                          </div>
                          <!-- /.vendor list block -->
                      </div>
                      <center>
                        <input type="hidden" name="service_id" value="<?php echo $id ?>">
                        <button type="submit" class="btn btn-default" name="submit" id="send_button">Send Documents</button>
                      </center>
                  </form>
                </div>
            </div>
        </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $('#id_proof').change(function (event) {
    var val = $("#id_proof").val();
      if (!val.match(/(?:gif|jpg|png|bmp|pdf)$/)) {
          $('#valid_id').text('Uploaded document should be either image or pdf');
          return false;
      }else{
        size = event.target.files[0].size;
        if(val.match(/(?:gif|jpg|png|bmp)$/)){
          if(size < 200000 ){
            $('#valid_id').text('Uploaded image should be greater than 200KB');
            $("#id_proof").val('');
            return false;
          }
        }
        $('#valid_id').text('');
      }
                pdffile = URL.createObjectURL(event.target.files[0]);
                $('#viewer').empty();
                if(val.match(/(?:gif|jpg|png|bmp)$/)){
                  $('#viewer').append("<img src='"+pdffile+"' ><font color='red'></font>");
                }else{
                  $('#viewer').append("<embed src='"+pdffile+"' ><font color='red'></font>");
                }
            });

  $('#service_proof').change(function (event) {
    var val = $("#service_proof").val();
      if (!val.match(/(?:gif|jpg|png|bmp|pdf)$/)) {
          $('#valid_spc').text('Uploaded document should be either image or pdf');
          return false;
      }else{
        size = event.target.files[0].size;
        if(val.match(/(?:gif|jpg|png|bmp)$/)){
          if(size < 200000 ){
            $('#valid_spc').text('Uploaded image should be greater then 200KB');
            $("#service_proof").val('');
            return false;
          }
        }
        $('#valid_spc').text('');
      }
                pdffile = URL.createObjectURL(event.target.files[0]);
                $('#pdfviewer').empty();
                if(val.match(/(?:gif|jpg|png|bmp)$/)){
                  $('#pdfviewer').append("<img src='"+pdffile+"' ><font color='red'></font>");
                }else{
                  $('#pdfviewer').append("<embed src='"+pdffile+"' ><font color='red'></font>");
                }
            });

  $('#send_button').click(function(){
      var val = $("#id_proof").val();
      var data_val = $("#id_proof").attr('my-data');
      if (val == '' && data_val == '') {
          $('#valid_id').text('Please upload id proof');
          return false;
      }else{
              if (!val.match(/(?:gif|jpg|png|bmp|pdf)$/) && data_val == '') {
                $('#valid_id').text('Uploaded document should be either image or pdf');
                return false;
            }else{
                size = event.target.files[0].size;
                if(val.match(/(?:gif|jpg|png|bmp)$/) && data_val == ''){
                  if(size < 200000 ){
                    $('#valid_id').text('Uploaded image should be greater then 200KB');
                    return false;
                  }
                }
              }

              $('#valid_id').text('');
        }
        
       
      var spcval = $("#service_proof").val();
      var data_spcval = $("#service_proof").attr('my-data');
      if (spcval == '' && data_spcval == '') {
          $('#valid_spc').text('Please upload service proof');
          return false;
      }else{
              if (!spcval.match(/(?:gif|jpg|png|bmp|pdf)$/) && data_spcval == '') {
                $('#valid_spc').text('Uploaded document should be either image or pdf');
                return false;
            }else{
                size2 = event.target.files[0].size;
                if(spcval.match(/(?:gif|jpg|png|bmp)$/) && data_spcval == ''){
                  if(size2 < 200000 ){
                    $('#valid_spc').text('Uploaded image should be greater then 200KB');
                    return false;
                  }
                }
              }
              $('#valid_spc').text('');
        }


      //$('#service_form').submit();
      alert('yes');
       
    });


</script>
 
<script type="text/javascript">

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

 
function alert_pop(msg){
   $.alert({
      title: 'Alert Message',
      content: msg,
      confirmButton: 'okay',
      confirmButtonClass: 'btn-warning',
      animation: 'bottom',
      icon: 'fa fa-check',
      opacity: 2,  
      backgroundDismiss: true
  });
}
</script>