<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-th" aria-hidden="true"></i> Product</a>
        <small>Add New product</small>
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
                        <h3 class="box-title">Add New product</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/product/insertnow" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
									<!--name-->                             
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" id="name" name ="name" class="form-control" required="required" placeholder="Enter Product Name" >
                                    </div> 
									<!--Price-->                             
                                    <div class="form-group">
                                        <label for="text">Price</label>
                                        <input type="text" id="price" name ="price" class="form-control" required="required" placeholder="Product Price" required >
                                    </div>
									<!--Items-->                             
                                    <div class="form-group">
                                        <label for="no_item">No Of Items</label>
                                        <input type="number" id="no_item" name ="no_item" class="form-control" required="required" placeholder="Number of Products" required >
                                    </div>
									
                                  
                                 </div> 
                                    
                                <div class="col-md-6"> 
                                   <!--Product Image -->                             
                                    <div class="form-group">
                                        <label for="image1">Product Image</label>
                                        <input type="file" id="image1" name ="image1" class="form-control"  placeholder="Choose product Image" required="required" >
                                    </div>

									<!--Product Image -->                             
                                    <!-- <div class="form-group">
                                        <label for="image1">Amazon Affiliate Image Link</label>
                                        <input type="text" id="image1" name ="image1" class="form-control"  placeholder="Enter Amazone Affiliate Img Link" required="required" >
                                    </div> -->

                                    <!--Product Image -->

									<!--Status-->
                                    <div class="form-group">
                                         <label for="status">Status</label>
                                         <select class ="form-control" name="status" id="status">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>	
                                    </div> 
                                    <!-- Renewal  -->
                                    <div class="form-group">
                                         <label for="status">Renewal Option</label>
                                         <input type="text" class="form-control" name="renewal"
                                          id="renewal" placeholder="Renewal Text Message (Optional)">
                                    </div> 
                                </div>
								<!-- <div class="col-md-12">
									// About 
                                    <div class="form-group">
                                         <label for="about">About Product</label>
                                        <textarea  rows="8" id="about" name ="about" class="form-control" placeholder="About Product" required ></textarea>
                                    </div>
								</div>	 -->
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
    
</div>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>  
<script>
    $("#category_id").change(function(){
        var id = $(this).val();
        
        $.ajax(
        {
            type:"POST",
            url:"<?php echo base_url();?>admin/product//get_sub_category", 
            data:"id="+id,
            success:function(returnVal)
            {
                //alert(returnVal);
                $("#sub_category_id").html(returnVal);
                
            }
        });
        return false;
    
    });
</script>
<script>
    $(document).ready(function(){
        $("#image1").change(function(){
           var id = "image1";
            var max_size = 2000000;
            file_validation(id,max_size);
        });$("#image2").change(function(){
           var id = "image2";
            var max_size = 2000000;
            file_validation(id,max_size);
        });$("#image3").change(function(){
           var id = "image3";
            var max_size = 2000000;
            file_validation(id,max_size);
        });

    });
    
  </script>
  <script>
   // Function file Validation

    function file_validation(id,max_size)
    {
        var fuData = document.getElementById(id);
        var FileUploadPath = fuData.value;
        

        if (FileUploadPath == ''){
            alert("Please upload Attachment");
        } 
        else {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpg"|| Extension == "jpg"|| Extension == "png") {

                    if (fuData.files && fuData.files[0]) {
                        var size = fuData.files[0].size;
                        
                        if(size > max_size){   //1000000 = 1 mb
                            alert("Maximum file size 1 MB");
                            $("#"+id).val('');
                            return;
                        }
                    }

            } 
            else 
            {
                alert("document only allows file types of  jpg , png");
                $("#"+id).val('');
            }
        }   
    }   

  </script>
