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
</style>

<section class="successSec" >
    <div class="container my-3">
      <div class="col-md-12   box-1 paymentsuccessBox" id="paymentsuccessBox">
         <div class="row form_con">
            <div class="col-sm-12 text-center" style="padding: 30px;border-right: 1px solid #e4e4e4;" >
              <img src="<?php echo base_url("assets/images/");?>payment-failed.png" width="200">
              <h2 style="font-size: 24px">Transaction Failed</h2>
            
               
 

            </div>
            
         </div>   
      </div>   
   </div>
</section>

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
      window.location.href = "<?php echo base_url()?>utils/setup.exe";
    }, 4000);
</script>



