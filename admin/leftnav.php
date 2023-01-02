<ul class="menu">
    <li>
        <p>Admin Site</p>
        <ul>
            <li><a href="index.php"><span class="fa fa-home"></span>Home</a></li>
            <?php
            if($_SESSION['sessUserGroupId']==1){
            ?>
            <li><a href="manageuser.php"><span class="fa fa-key"></span>Manage Users</a></li>
            <?php } ?>
            <li><a href="changepswd.php"><span class="fa fa-key"></span>Change Password</a></li>
            <li><a href="logout.php"><span class="fa fa-power-off"></span>Logout</a></li>
        </ul>
    </li>
    <li>
        <p>Manage Info</p>
        <ul>
            <?php
            if($_SESSION['sessUserGroupId']==1){
            ?>
            <li><a href="settings.php"><span class="fa fa-cogs"></span>Manage Global Settings</a></li>
            <li><a href="manage_constant.php"><span class="fa fa-cog"></span>Manage Home Page</a></li>
            <?php } ?>
            <li><a href="cms.php"><span class="fa fa-keyboard-o"></span>Manage Contents</a></li>
            <!--<li><a href="manage_resume.php"><span class="fa fa-keyboard-o"></span>Manage Resume</a></li>-->
    <!--      <li><a href="testimonials.php"><span class="fa fa-book"></span>Manage Testimonials</a></li>-->
          <li><a href="feedbacks.php"><span class="fa fa-mail-forward"></span>Manage Feedbacks</a></li> 
        </ul>
    </li>

</ul>