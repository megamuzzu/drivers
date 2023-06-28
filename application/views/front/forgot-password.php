<section>
  <div class="container py-5">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <div class="boxLogin pt-4 card px-4">
              <form method="post" id="check-email-form" action="">
                <?php if(isset($alert)){ ?>
                <div class="form-group ">
                   <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $alert; ?>                    
                  </div>
                </div>
                <?php } ?>

                <?php if(isset($success)){?>
                <div class="form-group py-5  text-center">
                  <p> Please check your email. Reset Password Link sent on your email address.</p>
                </div>
                <?php }else{?>
                <div class="form-group pb-3 ">
                   <h4>Validate Email</h4>
                </div>
                <div class="form-group">
                  <label> Order ID</label>
                  <input type="text" class="form-control" name="orderId" id="orderId" required placeholder="Order ID"  >
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
                <?php } ?>
              </form>
            </div>
        </div>
    </div>

  </div>
</section>