<!DOCTYPE html>
<html>
<head>
	<title>Stripe Example</title>
	<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
</head>
<body>

	<form action="<?php echo base_url(); ?>front/checkout/chargenow" method="post">
			<input type="hidden" id="pay_amount" name="pay_amount" value="<?php echo $pay_amount; ?>" />
  			<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				data-key="<?php echo $stripe['publishable_key']; ?>"
				data-description="Access for a year"
				data-amount="<?php echo $pay_amount*100; ?>"
				data-locale="auto">
          	</script>
	</form>


</body>
</html>