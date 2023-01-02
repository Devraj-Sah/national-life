<div class="block">
  <h3>Change Password</h3>
  <form name="frmMember" method="post" action="password" id="member">    
  	<div class="notice"></div>
    <?php if(!empty($err)){ ?>
    <div class="red"><?php echo $err; ?></div>
    <?php } elseif(isset($_GET['msg'])){ ?>
		<div class="alert-success"><?php echo $_GET['msg']; ?></div>
    <?php } ?>    
    <div class="clearfix"></div>
   	<label for="oldpassword">Old Password</label>
    <input type="password" name="oldpassword">
    <div class="clearfix"></div>
    <label for="newpassword">New Password</label>
    <input type="password" name="newpassword">
    <div class="clearfix"></div>
    <label for="confirmpassword">Confirm Password</label>
    <input type="password" name="confirmpassword">
    <div class="clearfix"></div>
    <label for="btnPassword"></label>
    <button name="btnPassword" value="Change" type="submit">Change</button>
  </form>
</div>