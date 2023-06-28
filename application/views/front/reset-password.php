<?php if(isset($success)){?>
<section>
  <div class="container py-5">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <div class="form-group py-4 text-center">
               <p class="text-success" ><?php echo $success; ?></p>
               <a href="<?= base_url('login')?>">Login Now</a>
            </div>
        </div>
      </div>
    </div>
  </section>
<?php }else if(isset($error)){?>
<section>
  <div class="container py-5">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
          
                <div class="form-group py-4">
                   <p class="text-danger" ><?php echo $error; ?></p>
                </div>
      </div>
    </div>
  </section>
<?php }else{  ?>

<section>
  <div class="container py-5">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <div class="boxLogin pt-4 card px-4">
              <form method="post" id="checkEmailForm" action="">
                <?php if(isset($alert)){ ?>
                <div class="form-group ">
                   <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $alert; ?>                    
                  </div>
                </div>
                <?php } ?>
                <div class="form-group pb-3 ">
                   <h4>Create New Password</h4>
                </div>
                
                  
                <div class="form-group">
                  <label> Enter New Password</label>
                  <input type="password" class="form-control" name="password" id="password" required placeholder="New Password" autocomplete="off"   >
                  <div id="pswd_info">
                      <h4>Password must meet the following requirements:</h4>
                      <ul>
                        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                        <li id="number" class="invalid">At least <strong>one number</strong></li>
                        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                        <li id="special" class="invalid">Be at least <strong>one special characters</strong></li>
                      </ul>
                   </div>
                </div>

                <div class="form-group">
                  <label> Re-enter Password</label>
                  <input type="password" class="form-control" name="password2" id="password2" required placeholder="Re-enter Password" minlength="6">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
               
              </form>
            </div>
        </div>
    </div>

  </div>
</section>

<?php }?>

<script type="text/javascript">
        window.invalid = 0;
        $('#password').keyup(function() {
            var pswd = $(this).val();
            window.invalid = 0;
            //validate the length
            if ( pswd.length < 8 ) {
                $('#length').removeClass('valid').addClass('invalid');
                window.invalid = 1;
            } else {
                $('#length').removeClass('invalid').addClass('valid');
            }

            //validate letter
            if ( pswd.match(/[A-z]/) ) {
                $('#letter').removeClass('invalid').addClass('valid');
            } else {
                $('#letter').removeClass('valid').addClass('invalid');
                window.invalid = 1;
            }

            //validate capital letter
            if ( pswd.match(/[A-Z]/) ) {
                $('#capital').removeClass('invalid').addClass('valid');
            } else {
                $('#capital').removeClass('valid').addClass('invalid');
                window.invalid = 1;
            }

            //special charecter
            if ( pswd.match(/[!@#$%^&*]/) ) {
                $('#special').removeClass('invalid').addClass('valid');
            } else {
                $('#special').removeClass('valid').addClass('invalid');
                window.invalid = 1;
            }

            //validate number
            if ( pswd.match(/\d/) ) {
                $('#number').removeClass('invalid').addClass('valid');
            } else {
                $('#number').removeClass('valid').addClass('invalid');
                window.invalid = 1;
            }
        }).focus(function() {
         $('#pswd_info').show();
        }).blur(function() {
            $('#pswd_info').hide();
        });

        </script>
    <style type="text/css">
            #pswd_info {
        position: absolute;
        width: 283px;
        padding: 15px;
        background: #fefefe;
        font-size: .875em;
        border-radius: 5px;
        box-shadow: 0 1px 3px #ccc;
        border: 1px solid #ddd;
}
#pswd_info h4 {
    margin:0 0 10px 0;
    padding:0;
    font-weight:normal;
    font-size: 14px;
    text-align: left;
}
#pswd_info ul {
    text-align: left;
}
#pswd_info::before {
    content: "\25B2";
    position:absolute;
    top:-12px;
    left:45%;
    font-size:14px;
    line-height:14px;
    color:#ddd;
    text-shadow:none;
    display:block;
}
.invalid {
    background:url(../images/invalid.png) no-repeat 0 50%;
    padding-left:22px;
    line-height:24px;
    color:#ec3f41;
}
.valid {
    background:url(../images/valid.png) no-repeat 0 50%;
    padding-left:22px;
    line-height:24px;
    color:#3a7d34;
}
#pswd_info {
    display:none;
}
</style> 
<script type="text/javascript">
  $("#checkEmailForm").submit(function(){
    if(window.invalid == 1){
      //alert(window.invalid);
      $('#pswd_info').show();
      return false;
    }
  });
</script>
