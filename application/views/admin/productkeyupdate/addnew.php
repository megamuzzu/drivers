<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/productkeyupdate"> <i class="fa fa-th" aria-hidden="true"></i> Product Key</a>
        <small>Add New productkey</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
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
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add New productkey</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/productkeyupdate/insertnow" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
									<!--name-->                             
                                    <div class="form-group">
                                        <label for="name">Eneter New Product Key</label>
                                        <input type="text" id="productKey" name ="productKey" class="form-control" required="required" placeholder="Eneter New Product Key" >
                                    </div> 
                                 </div> 
                               
                             </div>
                             
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>    
    </section>

    <section class="container " >
        <div class="box">
            <div class="row">
                <div class="col-md-12 " style="padding: 9px 32px">
                    <form enctype="multipart/form-data" method="post" role="form" action="<?php echo base_url() ?>admin/productkeyupdate/excelinsert" >
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputFile"><strong class="text-success"> OR</strong><small> Upload Product List by Excel (only CSV Files) </small></label>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file" id="file" size="150">
                                    <p class="help-block">Only CSV File Import.</p>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Upload</button>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                    <p for="exampleInputFile">Excel File Like this &nbsp; <i class="fa fa-hand-o-down fa-2x text-success"></i> </p>
                                   <img src="<?php echo base_url('assets/images/likethis.png');?>" class="img-fluid" width="200" >
                                </div>
                                
                             </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>    
    </section>
    
</div>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>  
