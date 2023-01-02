<?php
$counter = 0;
	if ($parentId == 0)
	{
		if(!empty($selectedGroupType))
		$result = $groups->getByParentIdAndType(0, $selectedGroupType);
	}
	else
	{
		$result = $groups->getByParentId($parentId);
	}
        
        {
       ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="2">
  
    <div  class="heading2">
			<?php	
			if ($parentId != 0)
			{
			$upResult = $groups->getById($parentId);
			$upRow = $conn->fetchArray($upResult);
			?>
			<div style="float:right; padding-right:5px;"><a href="<?php echo $pagename; ?>?parentId=<?php echo $upRow['parentId']; ?>&groupType=<?php echo $upRow['type']; ?>&level=<?=$_GET['level']-1; ?>"  class="headLink">UP</a></div>
			<?php
			}
			?>
			&nbsp;<?php
			if ($parentId == 0)
			{
				echo "Showing groups of type " . $selectedGroupType;
			}
			else
			{
				echo "Sub groups of " . $groups->getNameById($parentId, "en") . " of type " . $selectedGroupType;
			}
			?>    </div>
  
  <thead>
  <tr bgcolor="#F1F1F1">
    <td class="tahomabold11">S.No</td>
    <td class="tahomabold11">Name</td>
    <td class="tahomabold11">Type</td>
    <td class="tahomabold11">Hide</td>
    <td class="tahomabold11">Weight</td>
    <td class="tahomabold11">Action</td>
  </tr>
  </thead>
  <?php
	
	//print_r($hasAccess);
	if($result)
	while ($row = $conn->fetchArray($result))
	{
		//FOR ROLE ACCESS
		if( (!in_array($row['id'], $hasAccess) && $_GET['level']<3) && $_SESSION['sessUserGroupId']!=1){
			continue;
		}

		$counter++;
	?>
  <tr class="listHover" <?php if ($counter % 2 == 0) { echo "bgcolor='#F7F7F7'";} ?>>
    <td valign="top"><?php echo $counter; ?></td>
    <td valign="top"><?php echo $row['name']; ?></td>
    <td valign="top"><?php echo $row['linkType']; ?></td>
    <td valign="top"><?php echo $row['hide']; ?></td>
    <td valign="top"><?php echo $row['weight']; ?></td>
    <td valign="top"><?php
		if ($withOpen)
		{
			if ($row['linkType'] == "Normal Group")
			{
			?>
      <a href="<?php echo $pagename; ?>?parentId=<?php echo $row['id']; ?>&groupType=<?php echo $row['type']; ?>&open&level=<?=$_GET['level']+1; ?>">Open</a> /
      <?php
    	}
		}
		if ($withEdit)
		{
			$link = $pagename ."?id=" . $row['id'];
			$link .= "&parentId=" . $row['parentId'];		 
			$link .= "&groupType=" . $row['type'];
			?>
      <a href="<?php echo $link; ?>&level=<?=$_GET['level']; ?>">Edit</a> /
      <?php
		}
		if ($withDelete)
		{
			if ($groups->isDeletable($row['id']) || $row['linkType'] == "Video Gallery" || $row['linkType'] == "Gallery")
			{
				if($_SESSION['sessUserGroupId']==1){
			?>
      <a href="#" onclick="delete_confirmation('manage_cms.php?id=<?php echo $row['id']; ?><?php if(isset($_GET['parentId'])){ ?>&parentId=<?php echo $_GET['parentId']; } ?>&groupType=<?php echo $row['type'];?>&delete');">Delete</a>
      <?php
  				}	
			}
		}
    ?>    </td>
  </tr>
  <?php
	}
	?>
</table>
        <?php } ?>