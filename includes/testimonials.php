<script type="text/javascript">
	function testvalidation(thisform)
	{
		function emptyvalidation(entered, alertbox)
		{
			with (entered)
			{
				if (value==null || value=="")
				{
					if (alertbox!="") {alert(alertbox);} return false;
				}
				else {return true;}
			}
		} 
		with (thisform)
		{
			if (emptyvalidation(name,"Error ! Please type in your Name !")==false) {name.focus(); return false;}
			if (emptyvalidation(address,"Error ! Please type in your Address!")==false) {address.focus(); return false;}
			if (emptyvalidation(comments,"Error ! Please type in your comments !")==false) {comments.focus(); return false;}
			if (emptyvalidation(security_code,"Error ! Please type security code !")==false) {security_code.focus(); return false;}
			else { document.testimonial.submit(); }
		}
	}
	</script>

<div id="contentsPage">
  <h1>Share Your View</h1>
  <form name="frmtestimonial" action="testimonials/submit/ok" method="post" enctype="multipart/form-data" onsubmit="return testvalidation(this)" id="testimonials">
    <div style="padding-bottom:10px;">Please feel free to share your view with us. <a href="javascript:void(0);" onclick="document.getElementById('divform').style.display='block';document.getElementById('tests').style.display='none';" class="link">Click here</a> </div>
    <div id="divform" style="display:none;">
      <div class="notice">[Fields marked with <span class="red">*</span> are compulsory fields]</div>
      <?php
			if(isset($_REQUEST['msg']))
				$msg = $_REQUEST['msg'];
		
			if(!empty($msg))
			{
				echo '<div class="red" style="padding-bottom:7px;">'.ucfirst(str_replace("-", " ", $msg));
				if(isset($_REQUEST['msg']))
				echo '. It will be reviewed soon by Administrator';
				echo '</div>';
				$msg = "";
			}
			?>
      <label for="photo" style="padding-right:95px;">Photo :</label>
      <input name="filename" type="file" id="photo" size="25" />
      <div class="clear"></div>
      <label for="name" style="padding-right:95px;">Name :</label>
      <input name="name" type="text" class="textbox" id="name" value="<?php echo $_POST['name']; ?>" size="25" />
      <span class="red">*</span>
      <div class="clear"></div>
      <label for="address" style="padding-right:81px;">Address :</label>
      <input name="address" type="text" id="address" size="25" value="<?php echo $_POST['address']; ?>" />
      <span class="red">*</span>
      <div class="clear"></div>
      <div style="padding-top:30px; float:left;">
        <label for="view" style="padding-right:74px;">Your View :</label>
      </div>
      <textarea name="comments" cols="40" rows="5" class="textbox" id="comments"><?php echo $_POST['comments']; ?></textarea>
      <span class="red">*</span>
      <div class="clear"></div>
      <div style="padding-top:10px; float:left;">
        <label for="captcha_image">Security Code :</label>
      </div>
      <img src="includes/captcha.php?width=90&height=30&characters=6" id="captchaimage" />&nbsp; <a href="javascript: void(0);" onclick="document.getElementById('captchaimage').src = 'includes/captcha.php?width=90&height=30&characters=6&' + Math.random(); return false;" class="captchaReload">[Reload Image]</a>
      <div class="clear"></div>
      <label for="space" style="padding-right:132px;">&nbsp;</label>
      <input id="security_code" name="security_code" type="text" class="securitycode" maxlength="6" />
      <span class="red">*</span>
      <div class="clear"></div>
      <label for="space" style="padding-right:132px;">&nbsp;</label>
      <button name="btnTestimonials" type="submit" class="btn" value="Share">Share</button>
      <button name="Reset" type="reset" class="btn" value="Clear">Clear</button>
    </div>
  </form>
  <div class="tests">
    <?php 
	$pagename = "testimonials/";
	
	$sql = "SELECT * FROM testimonials where status=1 order by id DESC, onDate Desc";
	$newsql = $sql;

	$limit = LISTING_LIMIT;
	
	$return = Pagination($sql, "");
	
	
	$arr = explode(" -- ", $return);
	
	$start = $arr[0];
	$pagelist = $arr[1];
	$count = $arr[2];
	
	$newsql .= " LIMIT $start, $limit";
	
	$result = mysql_query($newsql);

	while($arrTests=mysql_fetch_array($result))
	{
		?>
    <div class="test">
      <div class="testlist"> <span class="date">
        <?php 
          $arrDate = explode(' ',$arrTests['onDate']); 
          $arrDate1 = explode('-',$arrDate[0]);
          echo date("M j, Y",mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]));
          ?>
        </span> <span><?php echo $arrTests['name']?>, </span><span><?php echo $arrTests['address']; ?>&nbsp;&nbsp;</span> </div>
      <div>
        <?php if(file_exists(CMS_TESTIMONIALS_DIR . $arrTests['image']) && !empty($arrTests['image'])){ ?>
        <img src="<?php echo CMS_TESTIMONIALS_DIR . $arrTests['image']; ?>" width="50" align="left" style="padding-right:5px;">
        <?php } ?>
        <?= nl2br($arrTests['comments']) ?>
        <div style="clear:both;"></div>
      </div>
    </div>
    <?php
	} 
	if($count > $limit)
	echo $pagelist;
	?>
  </div>
  <?php if(isset($_GET['submit']) || isset($_REQUEST['msg'])){ ?>
  <script type="text/javascript">
 document.getElementById('divform').style.display = 'block';
 </script>
  <?php } ?>
</div>
