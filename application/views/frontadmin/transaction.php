<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-credit-card" aria-hidden="true"></i> Transaction
        <small>Details</small>
      </h1>
    </section>
    
    <!--Alert section-->
    <section class="">
      <div class="col-md-12">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
            <?php } ?>
            <?php  
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- contant section-->
    <section class="content">
    	<?php if (!empty($detail)){?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <label><b>Subscription Details</b></label>
                        <?php if($detail->status =='active')
                        { ?>
                        <button type="button" class="btn btn-danger pull-right" id="cancel_subscription">Cancel Subscription</button>
                        <?php }?>
                        <hr/>
                    </div>
                    <div class="box-body mt-sm">
                        <!-- Subscription basic details -->
                        <div class="row">
                            <div class="col-sm-6">
                               <p><b>Subscription Id : </b> <?php echo $detail->subscription_id; ?></p>
                               <p><b>Customer Id : </b> <?php echo $detail->customer_stripe_id; ?></p>
                               <p><b>Customer Email : </b> <?php echo $detail->cutomer_email; ?></p>
                               <p><b>Plan Id : </b> <?php echo $detail->plan_id; ?></p>
                               <p><b>Plan Name : </b> <?php echo $detail->plan_name; ?></p>
                               <p><b>Quantity : </b> <?php echo $detail->quantity; ?></p>
                            </div>   
                            <div class="col-sm-6">
                               <p><b>Currency : </b> <?php echo $detail->currency; ?></p>
                               <p><b>Amount : </b> <?php echo $detail->amount; ?></p>
                               <p><b>Start Date : </b> <?php echo $detail->current_period_end; ?></p>
                               <p><b>End Date : </b> <?php echo $detail->current_period_end; ?></p>
                               <p><b>Status : </b> <?php echo $detail->status; ?></p>
                            </div>   
                        </div>    

                    </div>
                </div>    
                <!-- All Subscription list-->
                <div class="box box-primary">
                    <div class="box-header">
                        <label><b>All Subscription List</b></label><hr/>
                    </div>
                    <div class="box-body mt-sm">
                        <!-- Subscription basic details -->
                        <div class="row">
                            <div class="box-body table-responsive">
                              <table class="display" cellspacing="0" width="100%" id="example">
                                <thead>
                                <tr>
                                  <th>S.No.</th>
                                  <th>Event Type</th>
                                  <th>Event At</th> 
                                  <th>Start</th> 
                                  <th>End</th> 
                                  <th>Status</th> 
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i =1; 
                                    foreach($detail_all as $k=>$v){?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $v->event_type; ?></td>
                                      <td><?php echo $v->event_at; ?></td>
                                      <td><?php echo $v->subscription_current_period_start; ?></td>
                                      <td><?php echo $v->subscription_current_period_end; ?></td>
                                      <td><?php echo $v->status; ?></td>
                                    </tr>
                                    <?php $i++; }?>
                                </tbody>
                              </table>
                              
                            </div><!-- /.box-body -->
                           
                        </div>    
                    </div>
                </div> 

                <!-- All Transaction list-->
                <div class="box box-primary">
                    <div class="box-header">
                        <label><b>All Transaction List</b></label><hr/>
                    </div>
                    <div class="box-body mt-sm">
                        <!-- Subscription basic details -->
                        <div class="row">
                            <div class="box-body table-responsive">
                              <table class="display" cellspacing="0" width="100%" id="example">
                                <thead>
                                <tr>
                                  <th>S.No.</th>
                                  <th>Transaction Id</th> 
                                  <th>Charge Id</th> 
                                  <th>Amount</th> 
                                  <th>Currency</th> 
                                  <th>Refound Amount</th> 
                                  <th>Charge At</th> 
                                  <th>Status</th> 
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i =1; 
                                    foreach($detail_charge as $k=>$v){?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $v->transaction_id; ?></td>
                                      <td><?php echo $v->charge_id; ?></td>
                                      <td><?php echo $v->amount; ?></td>
                                      <td><?php echo $v->currency; ?></td>
                                      <td><?php echo $v->amount_refunded; ?></td>
                                      <td><?php echo $v->charge_at; ?></td>
                                      <td><?php echo $v->status; ?></td>
                                      
                                    </tr>
                                    <?php $i++; }?>
                                </tbody>
                              </table>
                              
                            </div><!-- /.box-body -->
                           
                        </div>    
                    </div>
                </div>


            </div>
        </div>
        <?php }else{?>
        	<h2 class="text-danger"><i class="fa fa-alert" >You are not Subscribe Any Service .</i></h2>
          <a href="<?php echo base_url(); ?>front/select_service/<?php echo $this->member_id; ?>">Subscribe Service</a>
        <?php }?>

    </section>
</div>

<!-- alert modeal-->
<div class="modal" id="alert_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title text-danger">Alert !</h2>
        
      </div>
      <div class="modal-body">
        <p ><b>Are You Sure To Cancel Subscription ?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_modal_conform" class="btn btn-danger">Confurm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
     // Modal show 
     $("#cancel_subscription").click(function(){
        $("#alert_modal").modal('show');

     });
     // Conform btn click
     $("#btn_modal_conform").click(function(){
        $("#alert_modal").modal('hide');
        window.location.href = "<?php echo base_url();?>frontAdmin/transaction/subscription_cancel"; 

     });

  });

</script>