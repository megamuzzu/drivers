<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-th" aria-hidden="true"></i> Product</a>
        <small>Edit</small>
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
                       
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                   <form role="form" id="member_form" action="<?php echo base_url() ?>admin/product/update" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                               <div class="col-md-6">
									<!--name-->                             
                                    <div class="form-group">
                                        <label for='name'>Product Name</label>
                                        <input type='text' id='name' name ='name' class='form-control' required='required' placeholder='Enter Product Name' value='<?php echo base64_decode($edit_data->name); ?>'  >

                                    </div> 
									<!--Price-->                             
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" name ="price" class="form-control" required="required" placeholder="Product Price" value="<?php echo $edit_data->price; ?>" >
                                    </div>
									<!--Items-->                             
                                    <div class="form-group">
                                        <label for="no_item">No Of Items</label>
                                        <input type="number" id="no_item" name ="no_item" class="form-control" required="required" placeholder="Number of Products" value="<?php echo $edit_data->no_item; ?>" >
                                    </div> 
									
                                  
                                 </div> 
                                    
                                <div class="col-md-6">   
									
									<!--Product Image -->                             
                                    <div class="form-group">
                                        <label for="image1">Product Image 1</label>
                                        <input type="file" id="image1" name ="image1" class="form-control"  placeholder="Choose product Image" >
                                        <!-- image check-->
                                        <?php if(!empty($edit_data->image1)){ ?>
                                            <span id="old_img1_con" >Image1 Is : <img src ="<?php echo base_url('uploads/product/'). $edit_data->image1; ?>" width="50" /> <?php echo $edit_data->image1; ?>
                                        <?php } ?>
                                        <input type="hidden" name="old_image1" id="old_image1" value="<?php echo $edit_data->image1; ?>"/>
                                    </div>

                                    <!--Product Image -->                             
                                    <!--Status-->
                                    <div class="form-group">
                                         <label for="status">Status</label>
                                         <select class ="form-control" name="status" id="status">
											<option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
											<option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
										</select>	
                                    </div>
                                    <!-- Renewal  -->
                                    <div class="form-group">
                                         <label for="status">Renewal Option</label>
                                         <h5>
                                            <input type='text' class='form-control' name='renewal'
                                          id='renewal' placeholder='Renewal Text Message (Optional)' value='<?php echo base64_decode($edit_data->renewal); ?>'>
                                         </h5> 
                                    </div> 


                                </div>
								
                             </div>
                             
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
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
    $(".delete_old_image2").click(function(){
        $("#old_img2_con").addClass('hidden');
        $("#old_image2").val('');
    });
    $(".delete_old_image3").click(function(){
        $("#old_img3_con").addClass('hidden');
        $("#old_image3").val('');
    });
</script>
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
  

