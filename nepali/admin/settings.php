<?php
include("init.php");
if (!isset($_SESSION['sessUserId'])) {//User authentication
    header("Location: login.php");
    exit();
}

if (isset($_POST['btnSubmit'])) {
    $errMsg = "";
    $pageTitle = trim($_POST['pageTitle']);
    $pageKeyword = trim($_POST['pageKeyword']);
    $pageDescription = trim($_POST['pageDescription']);
    $siteName = trim($_POST['siteName']);
    $siteEmail = trim($_POST['siteEmail']);
    $noReplyEmail = trim($_POST['noReplyEmail']);
    $siteDomain = trim($_POST['siteDomain']);
    $baseLocation = trim($_POST['baseLocation']);
    $settings->update($pageTitle, $pageKeyword, $pageDescription, $siteName, $siteEmail, $noReplyEmail, $siteDomain, $baseLocation);

    header("Location: settings.php?msg=Global Settings updated successfully");
    exit();
}

$row = $settings->getSettings();
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
                                                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td class="heading2">&nbsp;Manage Global Settings</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"><form name="form1" method="post" action="">
                                                                        <table border="0" width="60%" cellpadding="2" cellspacing="0" class="tahomabold11">
<?php if (!empty($errMsg)) { ?>
                                                                                <tr align="left">
                                                                                    <td colspan="2" class="err_msg"><?php echo $errMsg; ?></td>
                                                                                </tr>
<?php } ?>
                                                                            <tr>
                                                                                <td width="100"><strong>Page Title : </strong></td>
                                                                                <td><input type="text" name="pageTitle" value="<?php echo $row['pageTitle']; ?>" class="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Page Keyword  : </strong></td>
                                                                                <td><input type="text" name="pageKeyword" value="<?php echo $row['pageKeyword']; ?>" class="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Page Description:</strong></td>
                                                                                <td><textarea name="pageDescription" rows="5" cols="50"><?php echo $row['pageDescription']; ?></textarea></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td><strong>Site Name  : </strong></td>
                                                                                <td><input type="text" name="siteName" value="<?php echo $row['siteName']; ?>" class="text"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td><strong>Site Email  : </strong></td>
                                                                                <td><input type="text" name="siteEmail" value="<?php echo $row['siteEmail']; ?>" class="text"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td><strong>No Reply Email  : </strong></td>
                                                                                <td><input type="text" name="noReplyEmail" value="<?php echo $row['noReplyEmail']; ?>" class="text"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td><strong>Site Domain  : </strong></td>
                                                                                <td><input type="text" name="siteDomain" value="<?php echo $row['siteDomain']; ?>" class="text"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td><strong>Base Location  : </strong></td>
                                                                                <td><input type="text" name="baseLocation" value="<?php echo $row['baseLocation']; ?>" class="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td valign="top">&nbsp;</td>
                                                                                <td valign="top" align="left"><div align="left">
                                                                                        <input name="btnSubmit" type="submit" class="button" value="Change Details">
                                                                                    </div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </form></td>
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
                    </table></td>
            </tr>
            <tr>
                <td colspan="2"><?php include("footer.php"); ?></td>
            </tr>
        </table>
    </body>
</html>
