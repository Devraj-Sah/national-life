<script language="javascript">
function validateform(fm){
  if(fm.txtname.value == ""){
    alert("Please type your Name.");
    fm.txtname.focus();
    return false;
  } 
  if(fm.txtaddress.value == ""){
    alert("Please type your Address.");
    fm.txtaddress.focus();
    return false;
  }
  var goodEmail = fm.txtemail.value.match(/\b(^(\S+@).+((\.com)|(\.net)|(\.edu)|(\.mil)|(\.gov)|(\.org)|(\..{2,3}))$)\b/gi);    
  if(fm.txtemail.value == ""){
    alert("Please type your E-mail.");
    fm.txtemail.focus();
    return false;
  }
  if (!goodEmail) {
    alert("The Email address you entered is invalid please try again!")
    fm.txtemail.focus()
    return (false);
  }     
  if(fm.txtcomment.value == ""){
    alert("Please type your Comment.");
    fm.txtcomment.focus();
    return false;
  }
  if(fm.security_code.value == ""){
    alert("Please enter security code.");
    fm.security_code.focus();
    return false;
  }
  else if(fm.security_code.value.length < 6)
  {
    alert("Please enter valid length security code.");
    fm.security_code.focus();
    return false;
  }
}
</script>
<?php
if(!empty($feedbackmsg))
  $msg = $feedbackmsg;
elseif(isset($_REQUEST['msg']))
  $msg = ucfirst(str_replace("-",  " ", $_REQUEST['msg']));
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 cms-content">
            <div class="row">
                <div class='col-xs-12'>
                    <div class='inner-content-wrapper'>
                        <div class="inner-content-title">Feed Back</div>
                        <div class="inner-content">

<div class="feedback-form">
  
  <form name="frmFeedback" method="post" action="" onSubmit="return validateform(this);" class="form-horizontal" >
    
    <?php if(!empty($msg)){ ?>
    <div class="Feedback-msg bg-warning text-warning"><?php echo $msg; ?></div>
    <?php } ?>
    <br><br>
    <div class="form-group">
      <label for="name"  class="col-sm-2 control-label">Name : </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="txtname" value="<?php echo $txtname; ?>" placeholder="Enter Your Name" required />
      </div>
    </div>
    <div class="form-group">
      <label for="address" class="col-sm-2 control-label">Address :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="txtaddress" value="<?php echo $txtaddress; ?>" placeholder="Enter Your Address" />
      </div>    
    </div>
    <div class="form-group">
      <label for="contactno" class="col-sm-2 control-label">Contact No :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="txtphone" value="<?php echo $txtphone; ?>" placeholder="Enter Your Phone Number" />
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">E-mail :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="txtemail" value="<?php echo $txtemail; ?>" placeholder="Enter Your Email" /> 
      </div>   
    </div>
    <div class="form-group">
      <label for="view" class="col-sm-2 control-label">Comment : </label>
      <div class="col-sm-4">
        <textarea name="txtcomment" class="form-control" cols="" rows="5" placeholder="Your Comments" required><?php echo $txtcomment; ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="captcha_image" class="col-sm-2 control-label">Enter Captcha</label>
      <div class="col-sm-4">
        <img src="includes/captcha.php?width=90&height=30&characters=6" id="captchaimage" style="width:auto;" ><br><br>
        <a href="javascript: void(0);" onclick="document.getElementById('captchaimage').src = 'includes/captcha.php?width=90&height=30&characters=6&' + Math.random(); return false;" class="captchaReload">
          <i class="fa fa-refresh fa-2x"></i>
        </a>
        <input id="security_code" name="security_code" type="text" class="form-control" maxlength="6" required />
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-1">    
        <button name="btnFeedback" type="submit" class="btn btn-default" value="Share">Submit</button>
      </div>
    </div>
  </form>
</div>

                       </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>