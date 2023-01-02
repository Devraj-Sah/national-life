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

<div class="feedback-form">
  
  <form name="frmFeedback" method="post" action="" onSubmit="return validateform(this);">
    
    <?php if(!empty($msg)){ ?>
    <div class="Feedback-msg"><?php echo $msg; ?></div>
    <?php } ?>
    
    <label for="name">Name : </label>
    <div class="clear"></div>
    <input type="text" name="txtname" value="<?php echo $txtname; ?>" placeholder="Enter Your Name" />
    <div class="clear"></div>
    <label for="address">Address :</label>
    <div class="clear"></div>
    <input type="text" name="txtaddress" value="<?php echo $txtaddress; ?>" placeholder="Enter Your Address" />    
    <div class="clear"></div>
    <label for="contactno">Contact No :</label>
    <div class="clear"></div>
    <input type="text" name="txtphone" value="<?php echo $txtphone; ?>" placeholder="Enter Your Phone Number" />
    <div class="clear"></div>
    <label for="email">E-mail :</label>
    <div class="clear"></div>
    <input type="text" name="txtemail" value="<?php echo $txtemail; ?>" placeholder="Enter Your Email" />    
    <div class="clear"></div>
    <label for="view">Comment : </label>
    <div class="clear"></div>
    <textarea name="txtcomment" cols="" rows="" placeholder="Your Comments"><?php echo $txtcomment; ?></textarea>
    
    <div class="clear"></div>
    <label for="captcha_image">Enter Captcha</label>
    <div class="clear"></div>
    
    <img src="includes/captcha.php?width=90&height=30&characters=6" id="captchaimage" style="width:auto;" >
    <a href="javascript: void(0);" onclick="document.getElementById('captchaimage').src = 'includes/captcha.php?width=90&height=30&characters=6&' + Math.random(); return false;" class="captchaReload">
       <i class="fa fa-refresh fa-2x"></i>
    </a>
    <div class="clear"></div>
    
    <input id="security_code" name="security_code" type="text" class="securitycode medium" maxlength="6" />
    <div class="clear"></div>
    
    <button name="btnFeedback" type="submit" class="btn" value="Share"><img src="img/send.PNG" alt="sent button" ></button>
  </form>
</div>
