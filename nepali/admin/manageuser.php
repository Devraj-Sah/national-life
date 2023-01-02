<?php
require_once ('init.php');

if (!isset($_SESSION['sessUserId'])) {
   
    header("Location:login.php");
    exit();
}

if($_SESSION['sessUserGroupId']!=1){
    header("Location:index.php");
    exit();
}
if(isset($_POST['userSave'])){
    $frmErr = array();
    $fullname = trim($_POST['fullname']);
    $uname = trim($_POST['username']);
    $pswd = trim($_POST['passwd']);
    $status = trim($_POST['status']);

    if(empty($fullname)){$frmErr['fullname']='Fullname Cannot Be Empty!';}
    if(empty($uname)){$frmErr['username']='Username Cannot Be Empty!';}
    if(empty($pswd)){$frmErr['passwd']='Password Cannot Be Empty!';}
    if(empty($status)){$frmErr['status']='Status Cannot Be Empty!';}

    if(empty($frmErr)){
      $result = $users -> createNewUser($fullname,$uname,$pswd,$status);
      if($result)
      { 
        header("Location: manageuser.php?msg=Successfully Created!");
        exit();
      }
      else
      {
        $errMsg = "Failed!! Please Try again";
      }  
    }    
}

if(isset($_POST['userEdit'])){
    $frmErr = array();
    $id = trim($_POST['id']);
    $fullname = trim($_POST['fullname']);
    $uname = trim($_POST['username']);
    $pswd = trim($_POST['passwd']);
    $status = trim($_POST['status']);

    if(empty($id)){$frmErr['id']='Id Cannot Be Empty!';}
    if(empty($fullname)){$frmErr['fullname']='Fullname Cannot Be Empty!';}
    if(empty($uname)){$frmErr['username']='Username Cannot Be Empty!';}
    if(empty($pswd)){$frmErr['passwd']='Password Cannot Be Empty!';}
    if(empty($status)){$frmErr['status']='Status Cannot Be Empty!';}

    if(empty($frmErr)){
      $result = $users -> updateUser($id,$fullname,$uname,$pswd,$status);
      if($result)
      { 
        header("Location: manageuser.php?msg=Successfully Updated!");
        exit();
      }
      else
      {
        $errMsg = "Failed!! Please Try again";
      }  
    }    
}

if($_GET['action']=='edit'){
    $id = $_GET['id'];
    $userEdit = $users ->getUserById($id);
    if(!$userEdit){
        $errMsg = "NO USER EXIST WITH GIVEN ID";
    }
}


if($_GET['action']=='delete'){
    $id = $_GET['id'];
    $deleteResult = $users ->deleteUser($id);
    if($deleteResult)
    { 
        header("Location: manageuser.php?msg=Successfully Deleted!");
        exit();
    }
    else
    {
        $errMsg = "Failed!! Please Try again";
    }  
}

//Fetching Users List from Database;
$userList = $users ->listUsers();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo ADMIN_TITLE; ?> :: <?php echo PAGE_TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
                <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top">
                    
                    <!-- New Users  -->
                    <table width="100%" border="1" bordercolor="#ccc" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr><th class="heading2"><?php echo($userEdit)? 'Edit User':'Add New Users'; ?></th></tr>
                        </thead>
                        <tbody>
                            <tr align="left">
                                <td colspan="2" class="err_msg"><?php echo $errMsg; ?></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <form name="form1" method="post" action="">
                                        <table border="0" width="100%" cellpadding="2" cellspacing="0" class="tahomabold11">
                                            <tr>
                                                <td width="36%" align="left" valign="top"><div align="right">Enter Full Name :</div></td>
                                                <td width="64%" valign="top">
                                                    <div align="left">
                                                        <input name="fullname" type="text" class="text" value="<?php echo($userEdit)? $userEdit['fullname']:''; ?>" >
                                                        <?php echo($userEdit)? '<input name="id" type="hidden" value="'.$userEdit['id'].'" >':''; ?>
                                                        <?php echo ($frmErr['fullname'])? '<span class="err_msg">'.$frmErr['fullname'].'</span>':''; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="36%" align="left" valign="top"><div align="right">Enter username (Must Be Unique) :</div></td>
                                                <td width="64%" valign="top">
                                                    <div align="left">
                                                        <input name="username" type="text" class="text" value="<?php echo($userEdit)? $userEdit['username']:''; ?>" >
                                                        <?php echo ($frmErr['username'])? '<span class="err_msg">'.$frmErr['username'].'</span>':''; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="36%" align="left" valign="top"><div align="right"><?php echo($userEdit)? 'Enter New Password :':'Enter Password :'; ?></div></td>
                                                <td width="64%" valign="top">
                                                    <div align="left">
                                                        <input name="passwd" type="text" class="text">
                                                        <?php echo ($frmErr['passwd'])? '<span class="err_msg">'.$frmErr['passwd'].'</span>':''; ?>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td width="36%" align="left" valign="top"><div align="right">Status :</div></td>
                                                <td width="64%" valign="top">
                                                    <div align="left">
                                                        <select name="status">
                                                            <option value="A" <?php echo($userEdit && $userEdit['status']=='A')? 'Selected="Selected"':''; ?> >Active</option>
                                                            <option value="D" <?php echo($userEdit && $userEdit['status']=='D')? 'Selected="Selected"':''; ?> >Deactive</option>
                                                        </select>
                                                        <?php echo ($frmErr['status'])? '<span class="err_msg">'.$frmErr['status'].'</span>':''; ?>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr><td></td></tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top" align="left">
                                                    <div align="left">
                                                        <input name="<?php echo($userEdit)? 'userEdit':'userSave'; ?>" type="submit" class="button" value="Save">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- New Users  -->

                    <br>
                    <br>
                    <!-- Users Lists -->
                    <table width="100%" border="1" bordercolor="#ccc" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr ><th colspan="6" class="heading2">Users Lists</th></tr>
                        </thead>
                        <tbody>
                            <tr bgcolor="#F1F1F1">
                                <td class="tahomabold11">ID</td>
                                <td class="tahomabold11">Fullname</td>
                                <td class="tahomabold11">User Name</td>
                                <td class="tahomabold11">Status</td>
                                <td class="tahomabold11">Define Access</td>
                                <td class="tahomabold11">Actions</td>
                            </tr>
                            <?php
                            if(!empty($userList)){
                                // echo "<pre>";
                                // print_r($userList);
                                foreach($userList as $user):
                            ?>
                            <tr>
                                <td><?=$user['id']?></td>
                                <td><?=$user['fullname']?></td>
                                <td><?=$user['username']?></td>
                                <td><?php echo($user['status']=='A')?'Active':'Deactive'; ?></td>
                                <td>
                                    <a href="manage_user_access.php?id=<?=$user['id']?>&action=edit">Edit</a> 
                                </td>
                                <td>
                                    <a href="manageuser.php?id=<?=$user['id']?>&action=edit">Edit</a> | <a href="manageuser.php?id=<?=$user['id']?>&action=delete">Delete</a><?=$user['']?>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            }
                            else{ echo '<tr><th colspan="6" class="heading2">No User Found!!</th></tr>';}
                            ?>
                        </tbody>
                    </table>
                    <!-- Users Lists -->

                </td>
            </tr>
            <tr>
                <td colspan="2"><?php include("footer.php"); ?></td>
            </tr>
        </table>
    </body>
</html>