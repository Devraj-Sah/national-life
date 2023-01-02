<?php
if (isset($_REQUEST['msg']))
    $msg = $_REQUEST['msg'];

if (!empty($msg)) {
    echo '<div class="red" style="padding-bottom:7px; color:#AE0919;">' . ucfirst(str_replace("-", " ", $msg));
    if (isset($_REQUEST['msg']))
        echo '. It will be reviewed soon by Administrator';
    echo '</div>';
    $msg = "";
}
?>
<!-- Button trigger modal -->

<div class="col-xs-4" data-toggle="modal" data-target="#myModal">

    <a class="inquiry-a" style="cursor:pointer;font-size: 16px;color: #CABF0D;">Your precious feed back <span><img src="img/inquiry.png" alt=""/></span></a><div class="clearfix"></div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST"  name="inquiry" id="inquiry" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">FeedBack / Inquiry ...</h4>
                </div>
                <div class="modal-body">





                    <input type="text" name="name" placeholder="Name" class="form-control" style="margin-bottom: 5px;"/>
                    <input type="text" name="email" placeholder="E-mail" class="form-control" style="margin-bottom: 5px;"/>
                    <textarea name="comments" placeholder="Message" class="form-control" style="margin-bottom: 5px;"></textarea> 
                    <div class="clearfix"> 
                        <br>
                        <label for="captcha_image" class="label">Security Code :</label><span class="red">*</span>
                        <span><img src="includes/captcha.php?width=90&height=30&characters=6" id="captchaimage" /></span>&nbsp; <a href="javascript: void(0);" onclick="document.getElementById('captchaimage').src = 'includes/captcha.php?width=90&height=30&characters=6&' + Math.random();
                                return false;" class="captchaReload">[Reload Image]</a>
                        <div class="clearfix"></div><br/>
                        <input id="security_code" name="security_code" type="text" placeholder="Enter the Security Code" class="required securitycode form-control" maxlength="6" title="Please enter the security code" />

                    </div>

                </div>
                <div class="modal-footer">
                    <input style="margin-top: 10px;" name="submit0" id="submit"  type="submit" class="btn btn-primary"/>
                </div>
            </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->