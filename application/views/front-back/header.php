<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Zeno Strategics</title>
<link href="<?php echo base_url();?>assets/front/css/bootstrap.min.css" rel="stylesheet"  />
<link href="<?php echo base_url();?>assets/front/css/style.css" rel="stylesheet"  />
<link href="<?php echo base_url();?>assets/front/css/font-awesome.min.css" rel="stylesheet"  />
<script src="<?php echo base_url();?>assets/front/js/jquery-1.11.1.min.js"></script> 
</head>


<body>
<div class="top-bar">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-sm-9 col-md-9">
				<div class="top-bar1">
					
					<a href="mailto:support@zenostrategics.com"><i class=" fa fa-envelope"></i> support@zenostrategics.com</a>

					
					<a href="tel:0000-000-000"><i class="fa fa-phone"></i> (+) 0000-000-000</a>

				</div>
			</div>
			<?php $isLoggedIn = $this->session->userdata('loginstatus'); ?>
			<div class="col-lg-3 col-sm-3 col-md-3">
				<div class="top-bar2">
					<?php if(!isset($isLoggedIn) || $isLoggedIn != TRUE) {?>					
					<a href="<?php echo base_url();?>front/login"><i class="fa fa-lock"></i> Login</a>

					
					<a href="<?php echo base_url();?>front/registration"><i class="fa fa-user"></i> Register</a>
					<?php }else{ ?>
					<i class="fa fa-user"></i>
					<a href="<?php echo base_url();?>frontAdmin"> Welcome <?php echo $user = $this->session->userdata('first_name'); ?></a>
					<i class="fa fa-lock"></i>
					<a href="<?php echo base_url();?>front/login/logout">Logout</a>

					<?php } ?>

				</div>

			</div>
		</div>
	</div>
</div>


<div class="header clearHeader">
	<div class="container">
		<div class="row">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="<?php echo base_url('front/index_page');?>"><img src="<?php echo base_url();?>assets/front/images/logo.png" class="img-responsive" align=""  /></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <div class="navbar-form navbar-right">
				        <div class="form-group">
				          <a href="#"><i class="fa fa-search"></i></a>
				        </div>
				     
				      </div>	
				      <ul class="nav navbar-nav">
				        <li class=""><a href="<?php echo base_url('front/index_page');?>">Home <span class="sr-only">(current)</span></a></li>
				        <li><a href="<?php echo base_url('front/about');?>">About Us</a></li>
				     	<li><a href="<?php echo base_url('front/services/service_manual_trading');?>">Manual Trading</a></li>
				        <li><a href="<?php echo base_url('front/services/zeno_trading_stragegy');?>">Zeno Trading</a></li>
				        <li><a href="<?php echo base_url('front/contact');?>">Contact Us</a></li>
				        <li><a href="<?php echo base_url('front/faqs');?>">Q & A</a></li>
				      </ul>
				      
				      	
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

		</div>
	</div>
</div>

  <!-- slider start -->