<div class="kf_content_wrap" >
	<section>
		<div class="kf-booking-shdule"  style="margin-top:45px;">
			<h2 align="center" style="color:#FFF;">CREATE A MAGICAL EVENT  </h2><p></p>
			<h4 align="center">  Our idea generator will help you to come up with amazing theme ideas.</h4>
			 
				<br>
				<div class="container-fluid bg-search">
          <div class="container hide-980 ">
            <form>
              <ul>
                <li class="col-md-2 col-sm-6">
                  <select class="basic">
                    <option value="0">Event Places</option>
                    <?php 
                      if($event_places)
                      {
                        for ($i=0; $i < count($event_places); $i++) 
                        {   
                        ?>
                          <option value="<?php echo $event_places[$i]->location_id?>"><?php echo $event_places[$i]->location_name?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                </li>
                <li class="col-md-2 col-sm-6">
                  	<select class="basic">
	                    <option value="0">Age group</option>
	                    <option value="1">0-10</option>
						<option value="2">11-15</option>
						<option value="3">16-20</option>
						<option value="4">21-30</option>
						<option value="5">31-50</option>
						<option value="6">51& Up</option>
						<option value="7">All</option>
					</select>
                </li>
                <li class="col-md-2 col-sm-6">
                	<select class="basic">
	                    <option value="0">Craziness level</option>
	                    <option value="1">Conservative</option>
						<option value="2">Crazy</option>
						<option value="3">Elegant</option>
						<option value="4">Adventurous</option>
	                    <option value="5">Ultimate Creative</option>   
	                </select>
                </li>
                <li class="col-md-2 col-sm-6">
                  	<select class="basic">
	                    <option value="0">Season</option>
	                    <option value="1">Winter</option>
						<option value="2">Spring</option>
						<option value="3">Summer</option>
						<option value="4">Fall</option> 
                	</select>
                </li>
                <li class="col-md-2 col-sm-6">
                  	<div class="date-picker-des" data-provide="datepicker1">
					    <input type="text" id="my-datepicker2" class="basic" placeholder="Keywords">  
						<span class="add-on"></span>
					</div>
                </li>
                <li class="col-md-2 col-sm-6">
                  <button class="medium-btn">Search<!--<i class="fa fa-arrow-right"></i>--></button>
                </li>
              </ul>
            </form>
          </div>
          <div class="container display-980">
            <ul data-toggle="modal" data-target="#myModal">
              <li class="col-md-2 col-sm-8">
                <input type="text" placeholder="Event Places"/>
              </li>
              <li class="col-md-2 col-sm-4">
                <button  class="medium-btn" >Search<i class="fa fa-arrow-right"></i></button>
              </li>
            </ul>
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog"> 
                
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Search</h4>
                  </div>
                  <div class="modal-body">
                    <form>
              	<ul>
              
                <li class="col-md-12">
                  <select class="basic">
                    <option value="0">Event Places</option>
                    <option value="1">US</option>
                    <option value="2">Latvia</option>
                    <option value="3">Lithuania</option>
                    <option value="4">Estonia</option>
                  </select>
                </li>
                </ul>
                <ul>
                <li class="col-md-12">
                    <select class="basic">
                      <option value="0">Age group</option>
                      <option value="1">0-10</option>
            <option value="2">11-15</option>
            <option value="3">16-20</option>
            <option value="4">21-30</option>
            <option value="5">31-50</option>
            <option value="6">51& Up</option>
            <option value="7">All</option>
          </select>
                </li>
               </ul>
               <ul> 
                <li class="col-md-12">
                 <select class="basic">
                      <option value="0">Craziness level</option>
                      <option value="1">Conservative</option>
            <option value="2">Crazy</option>
            <option value="3">Elegant</option>
            <option value="4">Adventurous</option>
                      <option value="5">Ultimate Creative</option>   
                  </select>
                </li>
                </ul>
                <ul>
                <li class="col-md-12">
                <select class="basic">
                      <option value="0">Season</option>
                      <option value="1">Winter</option>
            <option value="2">Spring</option>
            <option value="3">Summer</option>
            <option value="4">Fall</option> 
                  </select>
                </li>
                </ul>
                <ul>
                <li class="col-md-12">
                <div class="date-picker-des" data-provide="datepicker1">
              <input type="text" id="my-datepicker2" class="basic" placeholder="Keywords">  
            <span class="add-on"></span>
          </div>
                </li>
                </ul>
                <ul>
                <li class="col-md-12 search-p">
                  <button class="medium-btn">Search<!--<i class="fa fa-arrow-right"></i>--></button>
                </li>
              </ul>
            </form>
             </div>
               <div class="modal-footer">
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal --> 
            
          </div>
        </div>
			</div>
		</div>
	</section>
</div>
 <script src="<?php echo base_url();?>themes/frontend/js/jquery.selectric.min.js"></script>  