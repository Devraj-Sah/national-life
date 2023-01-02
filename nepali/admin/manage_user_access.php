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

if(isset($_POST['userAccessSave'])){
    $access = $_POST['hasAccess'];
    $result = $users->userAccessSave($_GET['id'],$access);
    header("Location: manageuser.php?msg=Updated successfully");
    exit();
}



if($_GET['action']=='edit'){
    $id = $_GET['id'];
    $userEdit = $users ->getUserById($id);
    
    $userEditAccess = array();
    $resultAccess = $users->selectUserAccess($id);
    while($rowAccess = $conn -> fetchAssoc($resultAccess)){
      array_push($userEditAccess, $rowAccess['hasAccessId']);
    }

    if(!$userEdit){
        $errMsg = "NO USER EXIST WITH GIVEN ID";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo ADMIN_TITLE; ?> :: <?php echo PAGE_TITLE; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../js/vendor/jquery-1.11.1.min.js"></script>

        <script type="text/javascript">

        function checkAllCheckBox(value,type)
        {
            if('menu'==type){
                if($('#menu-'+value).is(':checked')){
                    $(".submenu-"+value).prop('checked',true);
                }
                else{
                    $(".submenu-"+value).prop('checked',false);
                }
            }
            else if('submenu'==type){
                if($('.submenu-'+value).is(':checked')){
                    $("#menu-"+value).prop('checked',true);
                }
                else{
                    $("#menu-"+value).prop('checked',false);
                }
            }
        }
        </script>
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
                            <tr><th class="heading2">Set User Access</th></tr>
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
                                                <td width="10%" align="" valign="top"><div align="">Full Name : <?php echo($userEdit)? $userEdit['fullname']:''; ?></div></td>
                                                <td width="74%" valign="top"></td>
                                            </tr>
                                            <tr>
                                                <td width="36%" align="" valign="top"><div align="">Username : <?php echo($userEdit)? $userEdit['username']:''; ?></div></td>
                                                <td width="64%" valign="top"></td>
                                            </tr>
                                            <tr><td></td></tr>
                                            <tr>
                                                <td valign="top" align="left">
                                                    <div align="left">
                                                        <input name="userAccessSave" type="submit" class="button" value="Save" style="height:40px;width:80px;background-color:blue;">
                                                    </div>
                                                </td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                            <tr><td></td></tr>
                                            <tr><td></td></tr>
                                            <tr>
                                                <th class="heading2"> &nbsp;&nbsp;Menu</th>
                                            </tr> 
                                             <tr>
                                                <td colspan="2">
                                                       <?php
                                                       //fetching Parent Menu
                                                       $menuList1 = $groups->getVisibleByParentIdAndType(0,'Menu');
                                                       $numRows = $conn->numRows($menuList1);
                                                       if ($numRows > 0) {
                                                        echo "\n" . '<ul';
                                                        echo ">\n";
                                                       }
                                                       while ($groupRow = $conn->fetchArray($menuList1)) {
                                                        echo '<li class="accessLevel">';

                                                        $isCheckedP = '';
                                                        if(in_array($groupRow['id'], $userEditAccess)){
                                                            $isCheckedP = 'checked="checked"';
                                                        }

                                                        echo '<input id="menu-'.$groupRow['id'].'" onclick="checkAllCheckBox('.$groupRow['id'].',\'menu\')" type="checkbox" '.$isCheckedP.' name="hasAccess[]" value="'.$groupRow['id'].'">';
                                                        echo $groupRow['name'];

                                                        if ($groupRow['linkType'] == "Normal Group"){
                                                            $menuList2 = $groups->getVisibleByParentIdAndType($groupRow['id'],'Menu');
                                                            $numRows2 = $conn->numRows($menuList2);
                                                            if ($numRows2 > 0) {
                                                                echo "\n" . '<ul';
                                                                echo ">\n";
                                                            }
                                                            while ($groupRow2 = $conn->fetchArray($menuList2)) {
                                                                echo '<li>';

                                                                $isCheckedC = '';
                                                                if(in_array($groupRow2['id'], $userEditAccess)){
                                                                    $isCheckedC = 'checked="checked"';
                                                                }
                                                                echo '<input class="submenu-'.$groupRow['id'].'" onclick="checkAllCheckBox('.$groupRow['id'].',\'submenu\')" '.$isCheckedC.' type="checkbox" name="hasAccess[]" value="'.$groupRow2['id'].'">';
                                                                echo $groupRow2['name'];
                                                                echo "\n";
                                                                echo '</li>';
                                                            }
                                                            if ($numRows2 > 0)
                                                                echo '</ul>';
                                                        }
                                                        echo "\n";
                                                        echo '</li>';
                                                       }

                                                       if ($numRows > 0)
                                                        echo '</ul>';
                                                       ?>
                                                </td>
                                            </tr>
                                            <tr><td></td></tr>
                                            <tr><td></td></tr>
                                            <tr>
                                                <th class="heading2"> &nbsp;&nbsp;Other Links</th>
                                            </tr> 
                                             <tr>
                                                <td colspan="2">
                                                       <?php
                                                       //fetching Parent Menu
                                                       $menuList1 = $groups->getVisibleByParentIdAndType(0,'Other Links');
                                                       $numRows = $conn->numRows($menuList1);
                                                       if ($numRows > 0) {
                                                        echo "\n" . '<ul';
                                                        echo ">\n";
                                                       }
                                                       while ($groupRow = $conn->fetchArray($menuList1)) {
                                                        echo '<li>';
                                                        echo '<input id="menu-'.$groupRow['id'].'" onclick="checkAllCheckBox('.$groupRow['id'].',\'menu\')" type="checkbox" name="hasAccess[]" value="'.$groupRow['id'].'" >';
                                                        echo $groupRow['name'];

                                                        if ($groupRow['linkType'] == "Normal Group"){
                                                            $menuList2 = $groups->getVisibleByParentIdAndType($groupRow['id'],'Other Links');
                                                            $numRows2 = $conn->numRows($menuList2);
                                                            if ($numRows2 > 0) {
                                                                echo "\n" . '<ul';
                                                                echo ">\n";
                                                            }
                                                            while ($groupRow2 = $conn->fetchArray($menuList2)) {
                                                                echo '<li>';
                                                                echo '<input class="submenu-'.$groupRow['id'].'" onclick="checkAllCheckBox('.$groupRow['id'].',\'submenu\')" type="checkbox" name="hasAccess[]" value="'.$groupRow2['id'].'">';
                                                                echo $groupRow2['name'];
                                                                echo "\n";
                                                                echo '</li>';
                                                            }
                                                            if ($numRows2 > 0)
                                                                echo '</ul>';
                                                        }
                                                        echo "\n";
                                                        echo '</li>';
                                                       }

                                                       if ($numRows > 0)
                                                        echo '</ul>';
                                                       ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- New Users  -->

                    

                </td>
            </tr>
            <tr>
                <td colspan="2"><?php include("footer.php"); ?></td>
            </tr>
        </table>
    </body>
</html>