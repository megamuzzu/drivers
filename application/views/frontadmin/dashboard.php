<style>
	.zeno-box
	{
		margin-bottom: 20px;
	    padding: 20px;
	    background: #ffff;
	    box-shadow: 4px 5px 7px 0px #b7b5b5;
	}
	.fa-icon
	{
		border: 1px solid #d8d8d8;
	    padding: 10px;
	    border-radius: 0px 9px 0px 9px;
	}
	.icon_con
	{
		width: 60px;
	    height: 60px;
	    /*border: 1px solid gray;*/
	    text-align: center;
	    border-radius: 50%;
	    padding: 9px;
	    float: left;
	}
	.text-white 
	{
	    color: #fff;
	}
	.details-div
	{
		margin-left: 90px;
    	margin-top: 5px;
	}
	.mb-2
	{
		margin-bottom: 15px;
	}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content">
 		<div class="col-sm-12">
 			<div class="row zeno-box">
 				<div class="col-sm-12">
 					<h4>
			        	<i class="fa fa-tachometer " aria-hidden="true"></i> Dashboard
			        	<small>Control panel</small>
			      </h4><hr/>
 				</div>
 				<!-- detils con-->
 				<div class="col-sm-6">
 					<div class="row mb-2">
 						<div class="icon_con bg-orange">
 							<i class="fa fa-user fa-3x text-white "></i>
 						</div>
 						<div class="details-div" >	
 							<label>Member</label>
 							<p><?php echo $this->first_name.' '.$this->last_name; ?></p>
 						</div>
 					</div>
 					<div class="row mb-2">
 						<div class="icon_con bg-aqua">
 							<i class="fa fa-users fa-3x text-white "></i>
 						</div>
 						<div class="details-div" >	
 							<label>Membership</label>
 							<?php if(isset($subscription_status)){ ?>
			              	 <p><?php echo ($subscription_status == 'canceled')?'Canceled':$subscription_start.' - '.$subscription_end; ?></p>
			              	 <?php }else{?>
			              	 <p>Painding..</p>
			              	 <?php }?>
 						</div>
 					</div>
 				</div>

				<!-- col-6 -->
 				<div class="col-sm-6">
 					<div class="row mb-2">
 						<div class="icon_con bg-light-blue">
 							<i class="fa fa-users fa-3x text-white "></i>
 						</div>
 						<div class="details-div" >	
 							<label>Membership Type</label>
 							<p><?php echo (isset($member_type))?$member_type:'Not Defined'; ?></p>
 						</div>
 					</div>

 					<div class="row mb-2">
 						<div class="icon_con bg-green">
 							<i class="fa fa fa-video-camera fa-3x text-white "></i>
 						</div>
 						<div class="details-div" >	
 							<!--label>Webinar Link</label-->
 							<?php foreach($webinar_link as $k=>$v) {?>
 							<?php if($k == 0) {?>
 							<label><?php echo $v->webinar_name;?> <small>(Webinar Link)</small></label>
 							<p><?php echo (isset($v))?$v->webinar_link:'Not Defined'; ?></p>
 							<?php }}?>
 						</div>
 					</div>	
				</div>

 			</div>
 		</div>
 	</section>
 	<section class="content">	
 		<div class="col-sm-12">
 			<!-- second box-->
 			<div class="row zeno-box">
 				<div class="col-sm-12">
 					<h4>
			        	<i class="fa fa-list " aria-hidden="true"></i> Last 5 Updates
			        	<small>Transaction</small>
			      </h4><hr/>
 				</div>
 				<!-- table -->
 				<div class="col-sm-12">
 					<?php if(!isset($updates_list)){?>
 						<?php if(isset($subscription) && empty($subscription)){?>
 						<h3><i class="fa fa-exclamation-triangle"></i> You Are Unsubscribe Member .. </h3>	
 						<a href="<?php echo base_url(); ?>front/select_service/<?php echo $this->member_id; ?>">Subscribe Service</a>
 						<?php }else{ ?>	
					  	<p>Empty Data ..</p>
					  	<?php }?>

					  	<?php }else{ $i = 1; ?>
 					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Event Type</th>
					      <th scope="col">Start</th>
					      <th scope="col">End</th>
					      <th scope="col">Action Date</th>
					      <th scope="col">Status</th>
					    </tr>
					  </thead>
					  <tbody>
					  	
					  	<?php foreach($updates_list as $v){?>
					    <tr>
					      <th scope="row"><?php echo $i;?></th>
					      <td><?php echo $v->event_type; ?></td>
					       <td><?php $temp =$v->subscription_current_period_start; echo ($v->subscription_current_period_start == '0000-00-00 00:00:00')?'00-00-0000 00:00:00':date("d-m-Y H:i:s", strtotime($temp)); ?></td>
					       <td><?php $temp =$v->subscription_current_period_end; echo ($v->subscription_current_period_end == '0000-00-00 00:00:00')?'00-00-0000 00:00:00':date("d-m-Y H:i:s", strtotime($temp)); ?></td>
					       <td><?php $temp =$v->event_at; echo ($v->event_at == '0000-00-00 00:00:00')?'00-00-0000 00:00:00':date("d-m-Y H:i:s", strtotime($temp)); ?></td>

					      <td><?php echo $v->status; ?></td>
					     
					    </tr>
					    <?php $i++; } ?>
					    
					  </tbody>
					</table>
					<?php } ?>
 				</div>
 			</div><!--// box-end-->

 		</div>
 		

 	
    </section>
</div>