 <div class="kf_content_wrap1" >
  <section class="search_footer_bg">
    <div class="kf-booking-shdule"> 
        <br>
        <div class="container-fluid">
          
          <h1 style="text-align: center; color: #FFF;">Congratulations</h1>
        </div>
      </div>
    </div>
  </section>
</div>
<section class="image_footer_bg">
   <div class="container">
      <div class="row">
        <div class="row">
    <div class="col-lg-12">
    </div>
</div>
 <form action="<?php echo base_url();?>home/razorpay2" method="POST" id="razorpay-form">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="order123"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="123"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="jabrdast product"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="123"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="123"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="Tejal"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="500"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="400"/>
</form>

    <div class="row">   
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
            <table class="table table-bordered table-hover table-striped print-table order-table" style="font-size:11px;">
                <thead class="bg-primary">
                    <tr>
                        <th width="15%" class="text-left" style="vertical-align: inherit">Image</th>
                        <th width="30%" class="text-left" style="vertical-align: inherit">Name</th>
                        <th width="15%" class="text-left" style="vertical-align: inherit">Price</th>
                        <th width="15%" class="text-right" style="vertical-align: inherit">Qty</th>
                        <th width="15%" class="text-right" style="vertical-align: inherit">Sub Total</th>                        
                    </tr>
                </thead>                        
                <tbody>                    
                    <tr>
                        <td class="text-left"><img width="80" height="80" src="https://4.imimg.com/data4/NJ/GL/MY-23677366/agarbathi-250x250.jpg"></td>
                        <td class="text-left">Agarbattii</td>
                        <td class="text-left">500</td>
                        <td class="text-right">1</td>
                        <td class="text-right">500</td>                        
                    </tr>                        
                </tbody>                        
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="<?php print site_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
        </div>
    </div>

      </div>
    </div>
</section> 



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "rzp_test_pT6MG4AYpzaPeI",
    amount: "50000",
    name: "Tejal",
    description: "Order Agarbatti",
    netbanking: true,
    currency: "INR",
    prefill: {
      name:"Tejal Ganvir",
      email: "tejal.ganvir@tissatech.com",
      contact: "7972152043"
    },
    notes: {
      soolegal_order_id: "order123",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        //alert(transaction.razorpay_payment_id);
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
            
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>
