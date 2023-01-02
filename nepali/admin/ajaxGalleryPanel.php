<div align="right" style="cursor: pointer;" onclick="addImage();">+ Add Image +</div>
<div id="uploadImageHolder">
  <div style="width:100px; float: left;">Image : </div>
  <div style="float:left;">
    <input type="file" name="galimage[]" class="file" multiple />
  </div>
  <br style="clear: both;">
  <div style="width:100px; float: left;">Caption : </div>
  <div style="float:left;">
    <input type="text" name="imageCaption[]" class="text" />
  </div>
  <br style="clear: both;">
</div>
<?php
if (isset($_GET['id']))
{
?>
<div>Existing Images </div>
<div style="padding:10px 10px 0 10px; margin-top: 8px; border:1px solid #333;">
  <?php
	$i=0;
	$pagename = "cms.php?id=" . $_GET['id'] . "&parentId=" . $_GET['parentId'] . "&groupType=" . urlencode($_GET['groupType']) . "&";		

	$sql = "SELECT * FROM groups WHERE parentId = '". $_GET['id'] . "' ORDER BY id DESC";
	$limit = ADMIN_GALLERY_LIMIT;
	include("../includes/paging.php");
	
	$imagesResult = $result;
	
	//$imagesResult = $galleries->getByGroupId($_GET['id']);
	while ($imageRow = $conn->fetchArray($imagesResult))
	{ $i++;
	?>
  <div class="adminGallery" style="<?php if($i%5 == 0) echo ' margin-right:0px;'; ?>">
  
    <div align="right">
	<input type="checkbox" style="margin-right: 128px;" name="delgalid[]" value="<?php echo $imageRow['id'];?>" >
      <div style="cursor: pointer; display: inline-block;" onclick="delete_confirmation('manage_cms.php?id=<?php echo $_GET['id']; ?>&parentId=<?php echo $_GET['parentId']; ?>&groupType=<?php echo $_GET['groupType']; ?>&imageId=<?php echo $imageRow['id']; ?>&deleteImage');">[x]&nbsp;</div>
    </div>
    <div align="center" style="width: 100%; height: 130px;"> <img src="../data/imager.php?file=../<?php echo CMS_GROUPS_DIR . $imageRow['image']; ?>&mw=125&mh=125&fix"> </div>
    <div align="center">
      <input type="hidden" name="oldCaptionIds[]" value="<?php echo $imageRow['id'] ?>" />
      <input type="text" name="oldCaptions[]" value="<?php echo $imageRow['shortcontents'] ?>" class="text" style="width:155px;" />
      <div align="left" style="padding:6px;">Weight : <input type="text" name="galweight[]" value="<?php echo $imageRow['weight'];?>" style="width:30px; margin-left:6px;" /></div>
      
    </div>
  </div>
  
  <?php
	}
	
	?>
	<input type="hidden" name="del_selected_btn" value="">
	<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<?php

}
?>
