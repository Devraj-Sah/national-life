<?php
include("init.php");
if (!isset($_SESSION['sessUserId'])) {//User authentication
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnAdd'])) {    
    $title = cleanQuery($_POST['title']);
    $urlname = cleanQuery($_POST['urlname']);
    $description = cleanQuery($_POST['description']);
    $status = $_POST['status'];
    $serviceId = $_POST['service'];
    if (isset($_POST['service']) && !empty($_POST['title']) && !empty($_POST['urlname'])) {
        $id = $project->save('', $title, $urlname, $description, $_POST['image'],$_POST['related_photos'], $_POST['service'], $_POST['status']);
        if ($id != FALSE) {
            $image = $project->getImageById($id);
            $msg = "Project Added Successfully!";
        }
        else
            $msg = "Adding Project Failed!<br>Alias Name May Exist Already!";
    } else {
        $msg = "Please Fill Required Field";
    }
}

if (isset($_GET['editId']) && $_GET['editId'] != NULL) {
    $id = cleanQuery($_GET['editId']);
    $projectResult = $project->getProjectById($id);
    $projectRow = $conn->fetchArray($projectResult);
    $title = $projectRow['title'];
    $urlname = $projectRow['urlname'];
    $description = $projectRow['shortcontents'];
    $status = $projectRow['status'];
    $image = $project->getImageById($id);
    $result = $project->getServiceByProjectId($id);
    while ($row = $conn->fetchArray($result)) {
        $serviceId[] = $row['id'];
    }
}

if (isset($_POST['btnUpdate'])) {
     
    $id = cleanQuery($_GET['editId']);
    $title = cleanQuery($_POST['title']);
    $urlname = cleanQuery($_POST['urlname']);
    $description = cleanQuery($_POST['description']);
    $status = $_POST['status'];
    $serviceId = $_POST['service'];
//    print_r($serviceId); die();
    if (isset($_POST['service']) && !empty($_POST['title']) && !empty($_POST['urlname'])) {
        $affected = $project->save($id, $title, $urlname, $description, $_POST['image'],$_POST['related_photos'], $_POST['service'], $_POST['status']);
        $image = $project->getImageById($id);
        $msg = "Project Updated Successfully!";
    } else {
        $msg = "Please Fill Required Field";
    }
}

if(isset($_GET['delId']))
{
    $project->delete($_GET['delId']);
    $msg = "Project Deleted Successfully!";
}

if(isset($_GET['delImage']))
{
    $id = cleanQuery($_GET['delImage']);
    $aff = $project->deleteImage($id);
    if($aff > 0)
    {
    $msg = "Image Deleted Successfully!";
    header ("Location: project.php?editId=".$id."");
    exit();
    }
    else
        $msg = "Failed to Delete Image!";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo ADMIN_TITLE; ?> :: <?php echo PAGE_TITLE; ?></title>
        <script language="javascript" src="../js/jquery-1.10.2.min.js"></script>
        <script language="javascript" src="../js/jquery.dataTables.min.js"></script>
        <script language="javascript" src="../js/cms.js"></script>

        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="../ckeditor/adapters/jquery.js"></script>
        <script type="text/javascript" src="../ckfinder/ckfinder.js"></script>

        <script type="text/javascript">
            CKFinder.setupCKEditor(null, '../ckfinder/');
        </script>
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="../css/demo_table.css" rel="stylesheet" type="text/css">
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
               cellspacing="5" bgcolor="#FFFFFF">
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
                                                                <td class="heading2">&nbsp;Manage Projects
                                                                    <span style="display:inline-block; float:right"><a href="project.php">Add</a></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"><form name="form1" method="post" action="" enctype="multipart/form-data">
                                                                        <table border="0" width="95%" cellpadding="2" cellspacing="0" class="tahomabold11">
                                                                            <?php if (!empty($msg)) { ?>
                                                                                <tr align="left">
                                                                                    <td colspan="2" class="err_msg"><?php echo $msg; ?></td>
                                                                                </tr>
                                                                            <?php } ?>                       
                                                                            <tr>
                                                                                <td><strong>Title: </strong></td>
                                                                                <td><input type="text" name="title" value="<?php echo $title; ?>" onchange="copySame('urlname', this.value);"class="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Alias Name: </strong></td>
                                                                                <td><input type="text" name="urlname" id="urlname" value="<?php echo $urlname; ?>" onchange="copySame('urlname', this.value);" class="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Description:</strong></td>
                                                                                <td><textarea name="description" rows="15" cols="90" id="editor5"><?php echo $description; ?></textarea></td>
                                                                            </tr>

                                                                            <?php if (!empty($image)) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td><strong>Existing Image : </strong></td>
                                                                                    <td>
                                                                                        
                                                                                        <img src="<?php echo "../" . CMS_PROJECT_DIR . $image; ?>" width="100" alt="">
                                                                                        <a href="project.php?delImage=<?php echo $id;?>"><i class="fa fa-trash-o fa-2x"></i></a></td>
                                                                                    
                                                                                </tr>
                                                                            <?php } ?>
                                                                            <tr>
                                                                                <td><strong>Image : </strong></td>
                                                                                <td><input type="file" name="image"></td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td><strong>Related Photos : </strong></td>
                                                                                <td><input type="file" name="related_photos[]" multiple></td>                                                                     
                                                                            </tr>
                                                                            <?php if(isset($_GET[editId]) || !empty($id))
                                                                            {
                                                                                if(isset($_GET[editId]))
                                                                                $resultRel = $project -> getRelatedPhotosByParentId($_GET['editId']);
                                                                                else
                                                                                $resultRel = $project -> getRelatedPhotosByParentId($id);    
                                                                                 $cnt = $conn -> numRows($resultRel);
                                                                                if($cnt > 0)
                                                                                { 
                                                                                ?>
                                                                            <tr>
                                                                                <td colspan="2">Existing Related Photos:</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <?php
                                                                                        
                                                                                        while($rowRel = $conn -> fetchArray($resultRel))
                                                                                        {
                                                                                        ?>
                                                                                    <div class="existing-image">
                                                                                        <a href="project.php?editId=<?php echo $_GET['editId'];?>&delId=<?php echo $rowRel['id'];?>">
                                                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                                                        </a>
                                                                                        <img src="<?php echo "../".CMS_PROJECT_DIR . $rowRel['image'];?>" alt="related-photos">
                                                                                    </div>
                                                                                    
                                                                                        <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php } }?>
                                                                            <tr>
                                                                                <td style="background: #575050;
                                                                                    padding: 5px;
                                                                                    color: #fff;"><strong>Service Type : </strong></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <?php
                                                                            $result = $project->getServices();
                                                                            while ($row = $conn->fetchArray($result)) {
                                                                                ?>
                                                                                <tr>

                                                                                    <td width="100%"><strong><?php echo $row['title']; ?></strong></td>
                                                                                    <td><input type="checkbox" name="service[]" value="<?php echo $row['id']; ?>" 
                                                                                        <?php
                                                                                        if (isset($serviceId)) {
                                                                                            for ($i = 0; $i < count($serviceId); $i++) {
                                                                                                if ($serviceId[$i] == $row['id']) {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            <tr>
                                                                                <td><strong>Status: </strong></td>
                                                                                <td>
                                                                                    <select name="status">
                                                                                        <option value="past" <?php if ($status == "past") echo "selected" ?>>Past</option>
                                                                                        <option value="ongoing" <?php if ($status == "ongoing") echo "selected"; if (empty($status)) echo "selected" ?>>Ongoing</option>
                                                                                        <option value="upcoming" <?php if ($status == "upcoming") echo "selected" ?>>Upcoming</option>
                                                                                    </select>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td valign="top">&nbsp;</td>
                                                                                <td valign="top" align="left">
                                                                                    <div align="left">
                                                                                        <?php
                                                                                        if (isset($_GET['editId'])) {
                                                                                            ?>
                                                                                            <input name="btnUpdate" type="submit" class="button" value="Update Project">
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <input name="btnAdd" type="submit" class="button" value="Add Project">
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </form></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">&nbsp;</td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" align="center" id="cmsTable" border="0" cellspacing="0" cellpadding="0">
                                                            
                                                            <thead>
                                                            <tr>
                                                                <td>S.no</td>
                                                                <td>Project Title</td>
                                                                <td>Alias Name</td>
                                                                <td>Image</td>
                                                                <td>Status</td>
                                                                <td>Services</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            </thead>
                                                            <?php
                                                            $i = 1;
                                                            $result = $project->getProject();
                                                            while ($row = $conn->fetchArray($result)) {
                                                                ?> 
                                                                <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td><?php echo $row['title']; ?></td>
                                                                    <td><?php echo $row['urlname']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if (file_exists("../" . CMS_PROJECT_DIR . $row['image']) && !empty($row['image'])) {
                                                                            ?>
                                                                            <img style="text-align:center; margin: 4px 0;" 
                                                                                 width="80"src="<?php echo "../" . CMS_PROJECT_DIR . $row['image']; ?>" alt="image">
                                                                             <?php } ?>
                                                                    </td>
                                                                    <td><?php echo $row['status']; ?></td>
                                                                    <td>
                                                                        <ul style="padding-left: 10px;
                                                                            list-style: square;"><?php
                                                                             $serRes = $project->getServiceByProjectId($row['id']);

                                                                             while ($serRow = $conn->fetchArray($serRes)) {
                                                                                 echo "<li>" . $serRow['title'] . '</li>';
                                                                             }
                                                                             ?></ul></td>
                                                                    <td>
                                                                        <a href="project.php?editId=<?php echo $row['id']; ?>" class="cmsBtn"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                                                        
                                                                        <a href="project.php?delId=<?php echo $row['id']; ?>" class="cmsBtn"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>

                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                            ?>
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
