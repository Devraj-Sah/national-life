<style type="text/css">
.login-form-admin{
  width: 400px;
  margin: auto;
  margin-top:50px; 
  background-color: #fff;
  box-shadow: 2px 2px 4px 6px #ddd;
  padding: 20px 20px;
}

tr.spaceUnder > td
{
  padding-bottom: 1em;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
   var flag = 0;

  //checking any error when save button is clicked
  $("#login").click(function(event) {
    if($("#username").val()==''||$("#psswrd").val()=='')
    {
      $("#err_main").html('Check For Compulsory  Fields <br>');
    }

    else
    { 
      $("#err_main").html('');

      if(flag==0)
      {
        $("#login_form").submit();
      }
      else
      { 
        $("#err_main").html('Check For Error');
      }
    }
  });


 //checking for error in input fields
  $( document ).on( 'blur', '.input_field', function(event){
    if($(this).val()=='')
    {
      $(this).focus();
      if(flag < 1)
      {
        $(this).parent().append('<div class="err_msg" id="err">Cannot be left blank</div>');
      }
      else
      {
        $("#err").html('Cannot be left blank');
      }
      flag = 1;
    }
    else
    {
      $("#err").remove();
      flag = 0;
    }
  });

});
</script>

<div class="login-form-admin">
  <form action="" method="POST" id="login_form">
    <table>
      <tbody>
        <thead><b>Admin Login</b></thead>
        <hr>
        <?php 
          if($this->session->userdata('flash_msg_err_login')!='')
          {
            echo '<div class="flash_msg_err">'.$this->session->userdata('flash_msg_err_login').'</div>';
            $this->session->unset_userdata('flash_msg_err_login');
          }
          
          if($this->session->userdata('flash_msg_logout')!='')
          {
            echo '<div class="flash_msg_succ">'.$this->session->userdata('flash_msg_logout').'</div>';
            $this->session->unset_userdata('flash_msg_logout');
          }
        ?>
        <div class="err_msg" id="err_main"></div>
        <div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div>
        <div class="special_msg">[ Username Max 20 Character ]</div><br>
        <tr class="spaceUnder">
          <td><label for="username">Username <span class="req">*</span></label></td>
          <td><input type="text" name="username" id="username" maxlength="20" class="input_field"></td>
        </tr>
        <tr class="spaceUnder">
          <td><label for="pssword">Password <span class="req">*</span></label></td>
          <td><input type="password" name="psswrd" id="psswrd" class="input_field"></td>
        </tr>
        <tr>
          <td></td>
          <td align="right"><input type="button" id="login" name="login" value=" Login " class="button_i"/></td>
        </tr>
        <tr>
          <td align="right" colspan="2" >Forgot your Password ? <a href="<?=base_url(); ?>/recover-password">Click here to recover!</a></td>
        </tr>
      </tbody>
    </table>
    
  </form>
</div>



