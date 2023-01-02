<?php
error_reporting(E_ERROR);
	/*include ("../fckeditor/fckeditor.php");
	$sBasePath="../fckeditor/";
	
	$oFCKeditor = new FCKeditor('shortcontents');
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $groupRow['shortcontents'];
	$oFCKeditor->Height		= "205";
	$oFCKeditor->ToolbarSet	= "Rupens";	
	$oFCKeditor->Create(); 
	
	$oFCKeditor = new FCKeditor('contents');
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $groupRow['contents'];
	$oFCKeditor->Height		= "300";
	$oFCKeditor->ToolbarSet	= "Rupens";	
	$oFCKeditor->Create(); 	*/
?>
<textarea name="shortcontents" class="ckeditor" id="editor1"><?php echo $groupRow['shortcontents']; ?></textarea><br />
<textarea name="contents" class="ckeditor" id="editor2"><?php echo $groupRow['contents']; ?></textarea>
