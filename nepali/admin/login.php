<?php 
require("loginprocess.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ADMIN_TITLE; ?></title>

<link href="../css/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="100%" height="300" align="center" valign="middle"><table width="42%"  border="0" align="center" cellpadding="0" cellspacing="3">
      <tr>
        <td>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frmUserLogin">
        <table width="100%"  border="0" cellpadding="4" cellspacing="0" class="tahomabold11" style="border:1px dashed #D6D6D6; padding-left:0;">              
              <tr>
                <td colspan="3" class="heading2" >&nbsp;Administrator Login Console </td>
              </tr>
              <?php if(!empty($errMsg)){ ?>
              <tr align="center">
                <td colspan="3" class="warning"><?php echo $errMsg; ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td width="11%">&nbsp;</td>
                  <td width="30%" align="left">Username:</td>
                <td width="59%" align="left"><input name="uname" type="text" class="text"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                  <td align="left">Password:</td>
                <td align="left"><input name="pswd" type="password" class="text"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left"><input name="btnUserLogin" type="submit" class="button" value=" Login "></td>
              </tr>
        </table>
        </form>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br></td>
  </tr>
  <tr>
    <td><?php include("footer.php"); ?></td>
  </tr>
</table>
</body>
</html>