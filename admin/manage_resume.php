<?php
include("init.php");
if (!isset($_SESSION['sessUserId']))
{//User authentication
  header("Location: login.php");
  exit();
}
if (isset($_GET['action']))
{

  $id = $_GET['id'];
  $row = $resume->getById($id);

  if ($row == FALSE)
  {
    header("Location: manage_resume.php?msg=Operation Failed");
    exit();
  }
  if ($_GET['action'] == 'delete')
  {
    if ($resume->delete($id))
    {
      if (file_exists('../files/resumes/' . $row['filename']) && !empty($row['filename']))
      {
        unlink('../files/resumes/' . $row['filename']);
      }
      header("Location: manage_resume.php?msg=Resume Deleted Successfully");
      exit();
    }
    else
    {
      header("Location: manage_resume.php?msg=Operation Failed");
      exit();
    }
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
                          <td valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="heading2">&nbsp;Manage Resume</td>
                              </tr>
                              <tr>
                                <td>
                                  <?php 
                                      if(isset($row))
                                      { ?>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td>Name:</td>
                                      <td><?php echo $row['fname']; ?></td>
                                      <td>Email:</td>
                                      <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Comments:</td>
                                      <td><?php echo $row['comments']; ?></td>
                                    </tr>
                                    <?php
                                      if(file_exists('../files/resumes/'.$row['filename']) && !empty($row['filename']))
                                      {
                                    ?>
                                    <tr>
                                      <td colspan='2'>
                                        <a href='../files/resumes/<?php echo $row['filename']; ?>'>Download File</a>
                                      </td>
                                    </tr>
                                      <?php } ?>
                                    
                                     
                                  </table>
                                  <?php
                                    
                                      }
                                    ?>
                                </td>
                              </tr>
                              <tr>
                                <td align="center">&nbsp;</td>
                              </tr>
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>


                </table></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
              <td class="bgborder">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="heading2">&nbsp;Showing Resume</td>
                              </tr>
                              <tr>
                                <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                    <thead>
                                      <tr bgcolor="#F1F1F1">
                                        <td class="tahomabold11">S.No</td>
                                        <td class="tahomabold11">Name</td>
                                        <td class="tahomabold11">Email</td>
                                        <td class="tahomabold11">Action</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $result = $resume->getAllResumes();
                                      $i = 1;
                                      while ($row = $conn->fetchArray($result))
                                      {
                                        ?>
                                        <tr class="listHover">
                                          <td valign="top"><?php echo $i++; ?></td>
                                          <td valign="top"><?php echo $row['fname']; ?></td>
                                          <td valign="top"><?php echo $row['email']; ?></td>
                                          <td>
                                            <a href="manage_resume.php?action=view&id=<?php echo $row['id']; ?>">View</a> |
                                            <a href="manage_resume.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                                          </td>
                                        </tr>
                                      <?php } ?>

                                    </tbody></table>
                                </td>
                              </tr>

                            </table></td>
                        </tr>
                      </table></td>
                  </tr>


                </table>

              </td>
            </tr>
          </table></td>
      </tr>

      <tr>
        <td colspan="2"><?php include("footer.php"); ?></td>
      </tr>
    </table>
  </body>
</html>
