<!DOCTYPE html>
<html>
<head>
	<title>Stripe Example</title>
	 <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
</head>
<body>
	<section class="content-header">
		<div class="row mt-md" style="margin-top: 20px;">
			<div class="col-md-4 col-md-offset-4">
				<label>Select Plan</label>
				<div class="form-group">
					<select id="plan" name="plan" class="form-control">
						<option value="">--Select Plan--</option>
						<?php foreach($plan as $k=>$v){?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
						<?php }?>
					</select>
				</div>

				<div class="form-group" id="form"></div>
			</div>
		</div>
	</section>
	
</body>
<script>
	$("#plan").change(function(){
		var plan = $(this).val();
		if(plan !='')
		{
			$.ajax(
			{
				type:"POST",
				url:"<?php echo site_url('front/checkout/strip_signup_form')?>?plan="+plan,
				data:'',
				success:function(returnVal)
				{
					$("#form").html(returnVal);
				}
			});
		}	
			

	});
</script>
</html>