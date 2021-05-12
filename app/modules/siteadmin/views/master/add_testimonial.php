<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
            <?php 
            if($this->session->flashdata('success'))
            {
              echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata ('success').'</div>';
            } 
            elseif($this->session->flashdata('error'))
            {
              echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata ('error').'</div>';
            }
            ?>
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Testimonials <a href="<?php echo base_url();?>siteadmin/master/view_testimonial"class="btn btn-danger" style="float: right;">View Testimonial</a></h4>
                  <p class="mb-0">This Section allows you to add/edit and view <b style="color: red;">Testimonials</b> .</p>
              </div>
              <div class="card-body">
                  <div class="px-3">
                      <form class="form form-horizontal" method="POST" action="<?php echo base_url();?>siteadmin/master/add_testimonial/<?php if($testimonial_get){ echo $testimonial_get['unique_id']; } ?>" enctype="multipart/form-data">
                        <div class="form-body">
                            <h4 class="form-section"><i class="ft-file-text"></i> Add Testimonail</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput5">Testimonial Name: </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="Testimonial Name" id="testimonial_name" list="demoList"  name="testimonial_name" value="<?php if($testimonial_get){ echo $testimonial_get['testimonial_name']; } ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Providers Post: </label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Providers Post" id="testimonial_tittle" list="demoList"  name="testimonial_tittle" value="<?php if($testimonial_get){ echo $testimonial_get['testimonial_tittle'];}?>" required>
                              </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control">Profile Pic: </label>
                                <div class="col-md-9">
                                  <label id="projectinput8" class="file center-block">
                                    <input class="form-control" name="testimonial_image"  type="file">                      
                                    <?php if($testimonial_get){
                                      ?>
                                      <input type="hidden" name="prev_img" value="<?php echo $testimonial_get['testimonial_image'];?>">
                                      <img src="<?php echo base_url();?>uploads/testimonial_image/<?php echo $testimonial_get['testimonial_image'];?>" width="100px; " height="100px;">
                                    <?php
                                    }?>
                                    <span class="file-custom"></span>
                                  </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput9">Testimonial Description: </label>
                                <div class="col-md-9">
                                  <textarea id="projectinput9" rows="5" class="form-control"placeholder="Testimonial Description" id="testimonial_description" list="demoList" value="" name="testimonial_description" value="<?php if($testimonial_get){echo $testimonial_get['testimonial_description'];}?>"><?php if($testimonial_get){echo $testimonial_get['testimonial_description'];}?></textarea>
                                </div>
                            </div>
                        </div>

                          <div class="form-actions">
                              <button type="submit" name = "submit" id = "submit" class="btn btn-raised btn-primary">
                                  <i class="fa fa-check-square-o"></i> Save
                              </button>
                              <a href="<?php echo base_url();?>siteadmin/page/add_testimonial" class="btn btn-raised btn-warning mr-1">
                                <i class="ft-x"></i> Cancel
                              </a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

</section>