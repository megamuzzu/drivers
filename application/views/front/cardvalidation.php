
  


  <style type="text/css">
    .ccard .card_icon,
    .ccard .status_icon {
      /* For a more robust cross-browser implementation, see http://bit.ly/aqZnl3 */
      display: inline-block;
      vertical-align: bottom;
      height: 23px;
      width: 27px;
    }
    .cardControl{
      width: 100%;
      font-size: 17px;
      padding: 3px 10px;
      border: 1px solid #d8d8d8;
      border-radius: 3px;
    }
    /* --- Card Icon --- */
    .ccard .card_icon {
      background: transparent url('assets/cardValidation/img/credit_card_sprites.png') no-repeat 30px 0;
      position: absolute;
      right: 34px;
    }
    .paymentDetailsCon .cardControl::placeholder{
    font-size: 12px!important;
  }
    
    /* Need to support IE6? These four rules won't work, so rewrite 'em. */
    .ccard .card_icon.visa       { background-position:   0   0 !important; }
    .ccard .card_icon.mastercard { background-position: -30px 0 !important; }
    .ccard .card_icon.amex       { background-position: -60px 0 !important; }
    .ccard .card_icon.discover   { background-position: -90px 0 !important; }

    /* --- Card Status --- */
    .ccard .status_icon {
      background: transparent url('assets/cardValidation/img/status_sprites.png') no-repeat 33px 0;
    }
    .ccard .invalid              { color: #AD3333; background: #f8e7e7; }
    .ccard .valid                { color: #33AD33; background: #e7f8e7; }
    .ccard .invalid .status_icon { background-position: 3px 0 !important; }
    .ccard .valid .status_icon   { background-position: -27px 0 !important; }
    .text-small{
      font-size: 11px;
    }
  </style>



    <div class="field ccard">
      <p class="status hidden">
        <span class="status_icon"></span>
        <span class="status_message text-small"></span>
      </p> 
      <p>
        <input class="cardControl " name="card_number" type="text" value="" placeholder="Credit Card Number"><!-- 4111111111111111 -->
        <span class="card_icon"></span>
      </p>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-sm-6">
          <input type="text"  class="form-control numbervalidation" placeholder="Exp Date [MMYY]"  name="billing-cc-exp" value=""   required="required" maxlength="4" /><!-- 1010 -->
        </div>
        <div class="col-sm-6">
          <input type="text"  class="form-control numbervalidation" placeholder="CVV"  name="cvv" value="" required="required"  minlength="3" maxlength="5" />
        </div>
      </div>  
    </div> 

  <script src="<?php echo base_url('assets/cardValidation/') ?>src/jquery.cardcheck.js"></script>
  <script>
    jQuery(function($) {
        
        // If JavaScript is enabled, hide fallback select field
        $('.no-js').removeClass('no-js').addClass('js');
        
        // When the user focuses on the credit card input field, hide the status
        $('.ccard input').bind('focus', function() {
            //$('.ccard .status').hide();
            $('.ccard .status').addClass('hidden');
        });
        
        // When the user tabs or clicks away from the credit card input field, show the status
        $('.ccard input').bind('blur', function() {
            //$('.ccard .status').show();
            $('.ccard .status').removeClass('hidden');
        });
        
        // Run jQuery.cardcheck on the input
        $('.ccard input').cardcheck({
            callback: function(result) {
                
                var status = (result.validLen && result.validLuhn) ? 'valid' : 'invalid',
                    message = '',
                    types = '';
                
                // Get the names of all accepted card types to use in the status message.
                for (i in result.opts.types) {
                    types += result.opts.types[i].name + ", ";
                }
                types = types.substring(0, types.length-2);
                
                // Set status message
                if (result.len < 1) {
                    message = 'Please provide a credit card number.';
                } else if (!result.cardClass) {
                    message = 'We accept the following types of cards: ' + types + '.';
                } else if (!result.validLen) {
                    message = 'Please check that this number matches your ' + result.cardName + ' (it appears to be the wrong number of digits.)';
                } else if (!result.validLuhn) {
                    message = 'Please check that this number matches your ' + result.cardName + ' (did you mistype a digit?)';
                } else {
                    message = 'Great, looks like a valid ' + result.cardName + '.';
                }
                
                // Show credit card icon
                $('.ccard .card_icon').removeClass().addClass('card_icon ' + result.cardClass);
                
                // Show status message
                $('.ccard .status').removeClass('invalid valid').addClass(status).children('.status_message').text(message);
            }
        });
    });
  </script>

  