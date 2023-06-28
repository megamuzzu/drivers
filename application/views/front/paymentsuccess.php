<?php 
/*   $arra = json_decode('{"qty":["1"],"id":["1"],"price":["4.99"]}');
   echo "<pre>";
   print_r($arra);
   echo "</pre>";*/
?>

<style>
    .productConSuccess h2,.productConSuccess h3{
        font-size: 13px!important;
        margin-bottom: 2px;
    }
    .productConSuccess p{
        font-size: 12px;
        margin-bottom: 4px;
    }
    .paymentsuccessBox h2,.paymentsuccessBox h3 {
        font-size: 16px;
        margin-bottom: 6px;
    }
    .paymentsuccessBox, .paymentsuccessBox p{
        font-size: 14px;
        margin-bottom: 12px!important;
    }
    .paymentsuccessBox table td,.paymentsuccessBox table th{
        padding: 3px!important;
    }

    table tr td {vertical-align: middle;}
</style>

<section class="successSec" >
    <div class="container my-3">
      <div class="col-md-10 offset-1 box-1 paymentsuccessBox" style="background: #f1f1f3;" id="paymentsuccessBox">
         <div class="row form_con">
            <div class="col-sm-4 text-center" style="padding: 30px;border-right: 1px solid #e4e4e4;" >
              <img src="<?php echo base_url("assets/images/");?>payment-success.png" width="200"><br/><br/>
              <h2 style="font-size: 24px">Transaction Successful</h2>
              
             <?php
                  if(!empty($mailed_template))
                  {
                    ?>
                      <a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-lg" ><span>Email Receipt <i class="fa fa-paper-plane"></i> </span></a>
                    <?php
                  }
             ?>
              
              <p class="relsendMailSuccess text-success hidden" ><i class="fa fa-check"></i> &nbsp;Email Receipt Sent.</p>


            </div>
            <div class="col-sm-8 " id="PrintSection" >
              <div id="pdfCon" class="hidden" > 
                <?php include_once "pdf-for-receipt.php" ?>
              </div>
              <div class="row paymentCon">
                  <a hidden class="downloadReceipt" id="DownloadPDF" href="javascript:void(0)">Download Receipt <i class="fa fa-download"></i> </a>
                <?php 
                  if(!empty($productData))
                  {


                    //". /*$userData->fname." ".$userData->lname*/ ." 
                    //". /*$userData->email*/."
                    echo '<div class="col-sm-12 py-3" style="background: #f1f1f3">';
                    echo "<div class='row'><div class='col-sm-4'><p><b>Customer</b></p></div><div class='col-sm-8'><p>  ". $orderData->fname ."  </p></div></div>";
                    echo "<div class='row'><div class='col-sm-4'><p><b>Email</b></p></div><div class='col-sm-8'><p>   ". $orderData->email ."   </p></div></div>";
                     
                    echo "<div class='row'><div class='col-sm-4'><p><b> City</b></p></div><div class='col-sm-8'><p>   ". $orderData->city ." </p></div></div>";
                    echo "<div class='row'><div class='col-sm-4'><p><b> State</b></p></div><div class='col-sm-8'><p>   ". $orderData->state ." </p></div></div>";
                    echo "<div class='row'><div class='col-sm-4'><p><b> Country</b></p></div><div class='col-sm-8'><p>   ". $orderData->country ." </p></div></div>";
                    echo "<div class='row'><div class='col-sm-4'><p><b> Zipcode</b></p></div><div class='col-sm-8'><p>   ". $orderData->zipcode ." </p></div></div><br><br> "; 
                     
                    $datas = json_decode($orderData->products,true);
                    
						
						
	 
 


	



                $this->load->model('admin/product_model');

                  if(!empty( $datas))
                  {
                      

                       echo "<table class='w-100' style='' >";
                      echo "<tr><th  >SR.</th><th colspan='9' >Product</th> <th style='width:60px;' >Qty</th><th class='pull-right' >Amount</th></tr>";  
                  $inc = 1;
                  $amount_order = 0;

                      foreach ($datas as $key => $value)
                      {

                         
 
          							   
                      $where = array();
                      $where['id'] = $value['product_id'];
                      $rData = $this->product_model->findDynamic($where);
                      $rDataProduct = $rData[0];
          							echo "<tr><td>".$inc."</td><td colspan='9' >".base64_decode($rDataProduct->name)."</td><td>".$value['no_item']."</td><td   >$ ".$value['price']*$value['no_item']."</td></tr>";  

          							$inc++;

          							
          							$amount_order =$amount_order + $value['price']*$value['no_item'];
                      }
                      
 					  
					  
                       
                    echo "<tr><th   colspan='10'  > </td><th      >Total</td> <th><p  > $". $amount_order." </p></th></tr>";
                     echo "</table>";
                     
                  }

                   
                    echo "</div>"   ;
                   
                    
                  }

                 ?>
                 <!-- payment details-->
                  
                  <div class="col-sm-6">  
                       <!-- <h3><b>Payment Details</b></h3>  -->
                      
                      
                     
                  </div>
                  <!--// payment details-->

              </div>
            </div>
         </div>   
      </div>   
   </div>
</section>


<!-- Modal -->
 

 
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Maile Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          if(!empty($mailed_template))
          {
            echo $mailed_template;
          }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>

<div id="PrintSection2">
  <div class="container">
    <?php //echo  $pdfTemplate; ?>
   </div> 
</div>   


<script type="text/javascript">
    $(document).ready(function(){
        //window.print();
        setTimeout(function() {
            $(".siteFooter").removeClass("hidden");
        }, 3000);
        
    });
</script>


<!-- HTML TO PDF Download -->
<script src="<?php echo base_url("assets/js/kendo.all.min.js")?>"></script>

<script>
  
      // Download PDF
    $('#DownloadPDF').click(function () {
      $("#pdfCon").removeClass("hidden");
    kendo.drawing
        .drawDOM("#pdfCon", //PrintSection
        { 
            paperSize: "A4",
            margin: { top: "1cm", bottom: "1cm" },
            scale: 0.8,
            height: 500
        })
            .then(function(group){
            kendo.drawing.pdf.saveAs(group, "driverfixer-Order-Receipt.pdf");
            $("#pdfCon").addClass("hidden");
        });

    });


    // Resend email

    $("#resendMail").click(function(){              
      url = "<?php echo base_url('paymentsuccess'); ?>";
      token = "<?php echo $token; ?>";
      $.ajax(
      {
        type:"GET",
        url:url,
        data:'token='+token+"&resendMail=1",
        success:function(returnVal)
        {
          if(returnVal ==  'sent'){
            $("#resendMail").addClass("hidden");
            $(".relsendMailSuccess").removeClass("hidden");
          }
        }
      });
    
  });



    // Default Download Software


    setTimeout(function(){
      //window.location.href = "<?php echo base_url()?>utils/setup.exe";
    }, 4000);
</script>



