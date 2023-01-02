<style type="text/css">
.login-form-admin{
  width: 450px;
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
  $("#create").click(function(event) {
    if($("#usrname").val()==''||$("#email").val()==''||$("#psswrd").val()==''||$("#confirm_psswrd").val()=='')
    {
      $("#err_main").html('Check For Compulsory  Fields <br>');
    }

    else
    { 
      $("#err_main").html('');

      if(flag==0)
      {
        $("#create_admin").submit();
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


  //matching password and confirm password field
  $('#confirm_psswrd').blur(function(event) {
    var pass1 = $("#psswrd").val();
    var pass2 = $("#confirm_psswrd").val();

    if(pass2 == '')
    {
      if(flag < 1)
      {
        $("#confirm_psswrd").parent().append('<div class="err_msg" id="err">Cannot be left blank</div>');
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

      if(pass1 !== pass2)
      {
        if(flag < 1)
        {
          $("#confirm_psswrd").parent().append('<div class="err_msg" id="err">Password Do not Match</div>');
        }
        else
        {
          $("#err").html('Password Do not Match');
        }
        flag = 1;
     }
     else
      {
        flag = 0;
        $("#err").remove();
      }
    }
  });

});
</script>


<div class="login-form-admin">
  <form action="" method="POST" id="create_admin">
    <table>
      <tbody>
        <thead><b>Create Admin</b></thead>
        <hr>
        <?php 
          if($this->session->userdata('flash_msg_err_reg')!='')
          {
            echo '<div class="flash_msg_err">'.$this->session->userdata('flash_msg_err_reg').'</div>';
            $this->session->unset_userdata('flash_msg_err_reg');
          }
        ?>
        <div class="err_msg" id="err_main"></div>
        <div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div>
        <div class="special_msg">[ UserName Max 20 Character ]</div><br>
        <tr class="spaceUnder">
          <td>
            <label for="usrname">Username <span class="req">*</span></label><br>
          </td>
          <td><input type="text" name="usrname" id="usrname" maxlength="20" class="input_field"></td>
        </tr>
        <tr class="spaceUnder">
          <td><label for="email">E-mail <span class="req">*</span> </label></td>
          <td><input type="text" name="email" id="email" class="input_field"></td>
        </tr>
        <tr class="spaceUnder">
          <td><label for="psswrd">Password <span class="req">*</span></label></td>
          <td><input type="password" name="psswrd" id="psswrd" class="input_field"></td>
        </tr>
         <tr class="spaceUnder">
          <td><label for="psswrd">Confirm-Password <span class="req">*</span></label></td>
          <td><input type="password" name="confirm_psswrd" id="confirm_psswrd" ></td>
        </tr>
        <tr>
          <td></td>
          <td align="right"><input type="button" id="create" name="create" value=" Save " class="button_i"/> </td>
        </tr>
      </tbody>
    </table>
    
  </form>
</div>

