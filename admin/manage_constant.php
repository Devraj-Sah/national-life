<?php
include("init.php");
if(!isset($_SESSION['sessUserId']))//User authentication
{
 header("Location: login.php");
 exit();
}

if(isset($_POST['btnAdd']))
{
	$constantName = cleanQuery($_POST['constantName']);
	$constantId = cleanQuery($_POST['constantId']);
	$description = cleanQuery($_POST['description']);
	if(!empty($constantName)&&!empty($_POST['constantId']))
	{
		if($constant -> add($constantName, $constantId, $description) !="")
		$errMsg = "Constant Added Succesfully!!";
		else
		$errMsg ="Adding Failed";
	}
	else
		$errMsg.="Please Select a Content Type!!";
}

if(isset($_POST['btnEdit']))
{ 
	$constantName = cleanQuery($_POST['constantName']);
	$constantId = cleanQuery($_POST['constantId']);
	$description = cleanQuery($_POST['description']);
	$id = $_POST['id'];
	if(!empty($constantName))
	{
		if($constant -> update($constantName, $constantId, $description, $id))
		$errMsg = "Constant Updated Succesfully!!";
		else
		$errMsg ="Updating Failed";
	}
	else
		$errMsg.="Please Select a Content Type!!";
	
	$row = $constant -> getById($id);
    $constantName = $row['constantName'];
	$constantId = $row['constantId'];
	$description = $row['description'];
}

if(isset($_GET['editId']) && !empty($_GET['editId']) && !isset($_POST['btnEdit']))
{
	$id = $_GET['editId'];
	$row = $constant -> getById($id);
    $constantName = $row['constantName'];
	$constantId = $row['constantId'];
	$description = $row['description'];
}

if(isset($_GET['delId']) && !isset($_POST['btnEdit']) && !isset($_POST['btnAdd']))
{
	$id = $_GET['delId'];
	if($constant -> delById($id))
	{
		$errMsg = "Constant Deleted successfully";
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ADMIN_TITLE; ?> :: <?php echo PAGE_TITLE; ?></title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
<script>
	function confirmDeltion()
	{
		if(confirm("Are you sure you want to delete?"))
		{
			return true;
		}
		else
		return false;
	}
</script>

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="heading2">&nbsp;Manage Client Side Constants <span style="display:inline-block; float:right"><a href="manage_constant.php"><?php if($_SESSION['sessUsername']=="Programmer") echo "Add New";
														else echo "Hide"; ?></a></span></td>
                          </tr>
                          <tr>
                            <td align="center"><form name="form1" method="post" action="">
                                <table border="0" width="60%" cellpadding="2" cellspacing="0" class="tahomabold11">
                                  <?php if(!empty($errMsg)){ ?>
                                  <tr align="left">
                                    <td colspan="2" class="err_msg"><?php echo $errMsg; ?></td>
                                  </tr>
                                  <?php } ?>
																	<?php
																	if($_SESSION['sessUsername']=="Programmer" || isset($_GET['editId']))
																	{
																	?>
																			<tr>
																				<td width="100"><strong>Constant Name : </strong></td>
																				<td><input type="text" name="constantName" value="<?php echo $constantName; ?>" class="text"></td>
																			</tr>
																			
																			<tr>
																				<td width="100"><strong>Content : </strong></td>
																				<td><select name="constantId" style='width:400px;'>
																					<option value="">Select Content</option>
																					<?php 
																						$sql = "SELECT id,name,type,linkType FROM groups WHERE
																								name!=\"\" ORDER By name asc";
																								$result = $conn->exec($sql);
																								while($row = $conn -> fetchArray($result))
																								{
																					
																					?>
																						<option value="<?php echo $row['id'];?>" <?php if($constantId == $row['id']) echo "selected"?>>
																						<?php echo $row['name']." (LinkType = ".$row['linkType'].")";?>
																						</option>
																						<?php } ?>
																						
																					</select>
																				
																				</td>
																			</tr>
																			<tr>
																				<td width="100"><strong>Description: </strong></td>
																				<td><textarea rows="4" cols="50" name="description" class="text"><?php echo $description; ?></textarea></td>
																			</tr>
																			
                                  <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top" align="left"><div align="left">
										<?php if(isset($_GET['editId']))
										{ ?>
										<input type="hidden" name="id" value="<?php echo $_GET['editId']; ?>" />
                                        <input name="btnEdit" type="submit" class="button" value="Update Constant">
										<?php } 
											else
											{
												 if($_SESSION['sessUsername']=="Programmer")
													{
								
										?><input name="btnAdd" type="submit" class="button" value="Add Constant">
										<?php } }?>
                                      </div></td>
                                  </tr>
								  <?php } ?>
                                </table>
                              </form></td>
                          </tr>
                          <tr>
                            <td align="center">&nbsp;</td>
                          </tr>
                        </table>
						
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                         
						  <?php if($_SESSION['sessUsername']=="Programmer")
									{
								?>
								 <tr>
                            <td colspan="7" class="heading2">&nbsp;Showing Constants</td>
                          </tr>
						  <tr bgcolor="#F1F1F1">
							<td class="tahomabold11">S.no</td>
							<td class="tahomabold11">Id</td>
							<td class="tahomabold11">Constant Name</td>
							<td class="tahomabold11">Constant Id</td>
							<td class="tahomabold11">Content Name</td>
							<td class="tahomabold11">Description</td>
							<td class="tahomabold11">Edit</td>
						  </tr>
						  <?php
							$i = 1;
							$result = $constant -> getAll();
							while($row = $conn -> fetchArray($result))
								
							{	$contentName = $groups -> getNameById($row['constantId']);
						  ?> 
								 <tr class="listHover">
							<td style="padding-left:6px;"><?php echo $i;?></td>
							<td style="padding-left:6px;"><?php echo $row['id'];?></td>
							<td style="padding-left:6px;"><?php echo $row['constantName'];?></td>
							<td style="padding-left:6px;"><?php echo $row['constantId'];?></td>
							<td style="padding-left:6px;"><?php echo $contentName;?></td>
							<td style="padding-left:6px;"><?php echo $row['description'];?></td>
							<td style="padding-left:6px;"><a href="manage_constant.php?editId=<?php echo $row['id']; ?>">Edit</a> | 
							<a href="manage_constant.php?delId=<?php echo $row['id']; ?>" onclick='return confirmDeltion();'>Delete</a>
							
							</td>
						  </tr>
						  <?php $i++;
						  }?>
						  <?php } 
							else{?>
							 <tr>
                            <td colspan="5" class="heading2">&nbsp;Showing Constants</td>
                          </tr>
							 <tr bgcolor="#F1F1F1">
							<td class="tahomabold11">S.no</td>
							
							<td class="tahomabold11">Constant Name</td>
							
							<td class="tahomabold11">Content Name</td>
							<td class="tahomabold11">Description</td>
							<td class="tahomabold11">Edit</td>
						  </tr>
						  <?php
							$i = 1;
							$result = $constant -> getAll();
							while($row = $conn -> fetchArray($result))
								
							{	$contentName = $groups -> getNameById($row['constantId']);
						  ?> 
								 <tr class="listHover">
							<td style="padding-left:6px;"><?php echo $i;?></td>
							
							<td style="padding-left:6px;"><?php echo $row['constantName'];?></td>
							
							<td style="padding-left:6px;"><?php echo $contentName;?></td>
							<td style="padding-left:6px;"><?php echo $row['description'];?></td>
							<td style="padding-left:6px;"><a href="manage_constant.php?editId=<?php echo $row['id']; ?>">Edit</a>
							
							</td>
						  </tr>
						  <?php $i++;
						  }}?>
						 </table>
						
						</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
