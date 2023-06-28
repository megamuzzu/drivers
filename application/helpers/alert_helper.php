<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function show_alert($type = '', $msg= '')
    {
        $strSuccess = '<div class="alert alert-success a_success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ##msg##</div>';
        $strError = '<div class="alert alert-danger a_danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ##msg##</div>';
        $strWarning = '<div class="alert alert-warning a_warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>##msg##</div>';

        if($type=="success"){
        	$msg= str_replace('##msg##', $msg, $strSuccess);
        }elseif($type=="error"){
        	$msg= str_replace('##msg##', $msg, $strError);
        }elseif($type=="warning"){
        	$msg= str_replace('##msg##', $msg, $strWarning);
        }
        echo $msg;
    }   
}

if ( ! function_exists('getVisIpAddr'))
{
    function getVisIpAddr() { 
      
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
        return $_SERVER['HTTP_CLIENT_IP']; 
    } 
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
        return $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } 
    else { 
        return $_SERVER['REMOTE_ADDR']; 
    } 
} 
 
}



if( ! function_exists('get_product_template') )

{

    function get_product_template()

    {

        $thisval = '<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" bgcolor="#f9fafc" style="background-color: #aae6b6;
   padding: 3px;width:590px;font-family: arial,sans-serif;">
   <tbody>
      <tr>
         <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="590" style="max-width:590px!important;width:590px;background:#ffffff;border-radius:6px">
               <tbody>
                  <tr>
                     <td align="center" valign="top">
                     </td>
                  </tr>
                  <tr>
                     <td align="center" valign="top">
                        <table border="0" align="center" width="40%" cellpadding="0" cellspacing="0">
                           <tbody>
                              <tr>
                                 <td valign="top" align="center">
                                    <div>
                                       <a href="##site_url##">
                                          <img width="600" vspace="0" hspace="0" border="0" alt="driverrepair24x7.com" style="float:left;max-width:700px;display:block" src="##site_logo##" class="CToWUd a6T" tabindex="0">
                                          <div class="a6S" dir="ltr" style="opacity: 0.01; left: 912px; top: 481px;">
                                       </a>
                                       <div id=":1dx" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    ##product_dtl##
                                    <table border="0" align="center" width="82%" cellspacing="0">
                                       <tbody>
                                          <tr>
                                             <td>
                                                <h5 style="font-family:arial,sans-serif;font-weight:400;font-size:11px;margin-top:0px;padding:30px 0 0px;text-align:center">For any questions, contact us at 
                                                   <span style="color:#007eff"><a href="mailto:support@driversfixer.com" rel="noreferrer noreferrer" target="_blank">support@driversfixer.com</a> </span> or call at
                                                   <span style="color:#007eff"><a style="color:#007eff;text-decoration:none" href="tel:+1-333-222-1111" rel="noreferrer noreferrer" target="_blank"> +1-333-222-1111</a>.</span>
                                                </h5>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <table border="0" align="center" width="82%" cellpadding="4" cellspacing="0">
                                       <tbody>
                                          <tr>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>';
        return $thisval;
    }

} 



if( ! function_exists('callcurl') )

{

function callcurl($data) {
    $ch = curl_init();
    if(isset($data['apikey']))
    {
      $key = $data['apikey'];
      unset($data['apikey']);
    }  

    $url = $data['url'];
    unset($data['url']);

    //$headers = array('Authorization: Bearer '.$stripeData['secret_key']);
    
    curl_setopt($ch, CURLOPT_URL,$url);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    return $result;

    }
  }








?>