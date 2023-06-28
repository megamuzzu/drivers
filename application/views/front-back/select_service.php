  <!-- banner start -->
  <section class="main-block">
    <div class="contact-bg">
    <div class="container-fluid text-center">
        <h1> CHOOSE SERVICE </h1>
    </div>
    </div>
  </section>
  
  
  
  <section class="body-contact">
    <div class="container">
        <!-- alert-->
        <div class="row">
            <?php $this->load->helper('form'); ?>
            
            <div class="col-md-12">
                
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
          
            <?php
            //$this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>                    
                </div>
            <?php }
            $success = $this->session->flashdata('success');
            if($success)
            {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $success; ?>                    
                </div>
            <?php } ?>
        </div>

        <?php if (isset($service_list)){?>    
        <!-- Service-->
        <div class="row">
            <?php foreach($service_list as $k=>$v){?>
            <div class="col-sm-4" >
                <div class="login-box">
                    <h3 class="text-upper text-center" ><strong><?php echo $v->service_name;?></strong></h3>
                    <p class="text-center"><strong>PRICE <span class="text-danger"> <?php echo $v->service_price;?></span>$</strong></p>
                    <div class="text-center mt-2">
                        <button type="button" class="btn btn-danger btn_service_<?php echo $v->id;?> btn_get_stripe_form" data-plan="<?php echo $v->id;?>">SELECT SERVICE</button><!--<?php echo base_url();?>front/member_subscription/<?php echo $user_id;?>/<?php echo $v->id;?>-->
                         <div class="form_con" id="form_<?php echo $v->id;?>"></div>
                    </div>    
                </div>
            </div> 
            <?php }?>  
        </div>
        <?php }else{?>
        <div class="row text-center">
            <h1><i> <?php echo $msg; ?> </i></h1>
        </div> 
        <?php }?>
    </div>
  
  </section>



 <!-- banner end -->


<!-- section start -->

<!-- section end -->

<script>
 $(document).ready(function(){
    // when change plan
    $(".btn_get_stripe_form").click(function(){
        var plan = $(this).attr("data-plan");
        var member = "<?php echo $user_id;?>";
        if(plan !='')
        {
          get_subscription_form(plan,member);
        }
        
     });
    
});


 //function
 function get_subscription_form(plan,member)
 { 
    $.ajax(
        {
            type:"POST",
            url:"<?php echo site_url('front/select_service/strip_signup_form')?>?plan="+plan+"&member="+member,
            data:'',
            success:function(returnVal)
            {
                $(".form_con").html('');
                $(".btn_get_stripe_form").removeClass('hidden');
                $(".btn_service_"+plan).addClass('hidden');
                $("#form_"+plan).html(returnVal);
            }
        });
      
 }
 
</script>
