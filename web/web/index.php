<?php
include 'clientobjects.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $pagePageTitle; ?></title>
        <meta name="description" content="<?php echo $pagePageDescription; ?>">
        <meta name="keyword" content="<?php echo $pageKeyword; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="http://<?php echo BASELOCATION; ?>">
         <STYLE TYPE="text/css">
      @font-face {
  font-family: 'PCSNEWN';
  src: url("<?php echo (SITE_ADDRESS); ?>fonts/PCSNEWN.TTF");

     
}
.mero{
  font-family: 'PCSNEWN', PCSNEWN;
     

}
    </STYLE>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/prettyPhoto.css">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/cms.css">
        <link rel="stylesheet" href="css/main.css">        
        <link rel="icon" href="images/fab_icon.png" type="image/x-icon" />
        <!--for fancy box-->
        <link rel="stylesheet" href="fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" href="fancybox/helpers/jquery.fancybox-buttons.css" />
        <link rel="stylesheet" href="fancybox/helpers/jquery.fancybox-thumbs.css" />

        <script src="js/vendor/jquery-1.11.1.min.js"></script>
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<style type="text/css">
    
.news {
  background: url(../img/opa.png) repeat;
  min-height: 350px;
  padding: 10px;
}
.news h3
{
  text-align: left;
  padding-left: 10px;
}
</style>
    </head>
    <body onLoad="goforit()">

        <!--FOR POPUP IMAGE AND TEXT-->

        <?php
        if (isHome()) {
            $id = $constant->getId(69);
            $result = $groups->getById($id);
            while ($row = $conn->fetchArray($result)) {
                if (!empty($row['image']) && file_exists(CMS_GROUPS_DIR . $row['image'])) {
                    $size = getimagesize(CMS_GROUPS_DIR . $row['image']);
                    ?>

                    <script type="text/javascript">
                    $(document).ready(function() {
                        $(".popup").hide();
                        resizeDiv();
                        $(".popup").show();

                        $(".popOverlay").click(function() {
                            $(this).hide();
                            $(".popup").hide();
                        });
                        $(".popup-cross").click(function(){
                            $(".popOverlay").hide();
                            $(".popup").hide();
                        });
                    });

                    window.onresize = function(event) {
                        resizeDiv();
                    }

                    function resizeDiv() {
                        vpw = $(window).width() / 2 - <?php echo $size[0] / 2; ?> + 'px';
                        vph = $(window).height() / 2 - <?php echo $size[1] / 2; ?> + 'px';
                       
                        if($(window).width() <= (<?php echo $size[0]; ?> + 10)) {                          
                          vpw = 0;                          
                        }
                        
            //          console.log(vpw);
                        $('.popup').css({'top': vph, 'left': vpw});
                    }
                    </script>

                    <div class="popOverlay"></div>
                    <div class="popup">
                        <span class="popup-cross pull-right">&cross;</span>
                        <div style="padding:25px; position:absolute; top:0px;"><?php echo $row['contents']; ?></div>
                        <img src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" class="img-responsive" alt="">
                    </div>
                    <?php
                }
            }
        }
        ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->




        <!-- Top Header Section Starts-->
        <div id="hnw" class="header-nav-wrapper">
            <section class="topheader">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 visible-xs">
                            <div class="row">
                                <aside class="logo col-xs-12 text-center" style="margin:10px 0px;">
                                    <header>
                                        <h1>
                                            <a href="home" class="clearfix" title="Nepal Life Insurance Company Limited">
                                                <img class="logo-img" src="img/logo.png"  alt="Nepal Life Insurance Company Limited"/>
                                            </a>
                                        </h1>
                                    </header>
                                </aside>
                                <div class="col-xs-12 col-sm-12 col-md-4 ">
                                    <div class="row">
                                        <div class="col-xs-12 english_nepali text-center">
                                            <a href="#" class="english" title="English">english</a>\
                                            <a href="#" class="english" title="English">nepali</a>
                                            <!--<a href="nepali/" class="nepali" title="Nepali">nepali</a>-->
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="head-Links">
                                            
                                                <?php
                                                $id = $constant->getId(73);
                                                $result = $groups->getByParentId($id);
                                                while ($row = $conn->fetchArray($result)) {
                                                    ?>
                                                    <a target="_blank" href="<?php if($row['linkType']=='Link'){echo $row['contents'];}else {echo $row['urlname'];} ?>">
                                                    <?php echo $row['name']; ?>
                                                    </a>
                                                    
                                                    <?php
                                                }
                                                ?>
                                                 <a href="http://202.166.205.74:8080/" target="_blank">Term Policy Enquiry</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <form  method = "post" action = "search">
                                                        <div id="searchDiv1"  style="display:block;">
                                                            <input class="form-control search-input border-none" type = "text" id="skey" placeholder = "search" name = "key"/>
                                                            <input class="btn btn-default border-none" type = "submit" value = "GO" />
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-xs-12" >
                                            <div id="ajaxSearch" style="display:none;">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>      
            </section>

            <div class="clearfix"></div>

            <!-- Top Header Section Ends-->

            <!-- Logo Section & Search Section Starts-->

            <section class="logo_search hidden-xs">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <aside class="logo">
                                <header><h1><a href="" class="clearfix" title="Nepal Life Insurance Company Limited"><img src="img/logo.png" class="logo-img" alt="Nepal Life Insurance Company Limited"/></a></h1></header>
                            </aside>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4 tel-search-wrapper ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12 english_nepali text-right">
                                            <div class="clearfix">
                                                <a href="#" class="english" title="English">english</a>\ <a href="<?php echo (SITE_ADDRESS); ?>nepali" class="english" title="English">nepali</a>
                                            <!--<a href="nepali/" class="nepali" title="Nepali">nepali</a>-->
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="head-Links">
                                                <?php
                                                $id = $constant->getId(73);
                                                $result = $groups->getByParentId($id);
                                                while ($row = $conn->fetchArray($result)) {
                                                    ?>
                                                    <a target="_blank" href="<?php if($row['linkType']=='Link'){echo $row['contents'];}else {echo $row['urlname'];} ?>"><?php echo $row['name']; ?></a>
                                                    <?php
                                                }
                                                ?>
                                                <a href="http://202.166.205.74:8080/" target="_blank">Term Policy Enquiry</a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="clearfix">
                                        <div class="col-xs-10">
                                            <form  method = "post" action = "search">
                                                <div id="searchDiv" class = "input-group padding-right-0 row">
                                                    <input class="form-control search-input border-none" type = "text" id="skey1" placeholder = "search" name = "key"/>
                                                    <input class="btn btn-default border-none" type = "submit" value = "GO" />
                                                    <div class="clearfix"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="top-class row"><span id="searchControl" class="serch-conrtol search-img"> </span><div class="clearfix"></div></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xs-12" >
                                    <div id="ajaxSearch1" style="display:none;">
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Logo Section & Search Section Ends-->

            <div class="clearfix"></div>

            <!-- Navigation Section Starts-->
            <section id="navigation" class="navigation">
                <div class="container">     
                  <div id='cssmenu'>
                    <?php
                    createMenu(0, 'Menu')
                    ?>
                  </div>
                  <div class="menu">
                    <?php
                    createExtraMenu(0, 'Menu')
                    ?>
                  </div>
                 
                </div>  
            </section>
            <!-- Navigation Section Ends-->
        </div>




        <div id="top-balance" class="clearfix"></div>
        <br>
        <?php
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if (file_exists('includes/' . $action . '.php')) {
                include('includes/' . $action . '.php');
            }
        } elseif (isset($pageLinkType)) {

            include('includes/cmspage.php');
        }
        else
            include('includes/default.php');
        ?>

        <div class="clearfix"></div>

        <!--Contact Us Section Open -->
<?php /* ?>
        <section class="contact_details">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <aside class="location row">
                            <div class="col-xs-2 prr"><img src="img/location1.png" class="img-responsive"/></div>
                            <div class="col-xs-10">
                                <?php
                                $id = $constant->getId(62);
                                $title = $constant->getTitle(62);
                                $result = $groups->getById($id);
                                $row = $conn->fetchArray($result);
                                ?>
                                <header><?php echo $title; ?></header>
                                <article>
                                    <?php echo $row['shortcontents']; ?>
                                </article>
                            </div>
                        </aside>                
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <aside class="location row">
                            <div class="col-xs-2 prr"><img src="img/tel1.png" class="img-responsive"/></div>
                            <div class="col-xs-10">
                                <?php
                                $id = $constant->getId(64);
                                $title = $constant->getTitle(64);
                                $result = $groups->getById($id);
                                $row = $conn->fetchArray($result);
                                ?>
                                <header><?php echo $title; ?></header>
                                <article>
                                    <?php echo $row['shortcontents']; ?>
                                </article>

                            </div>
                        </aside>                
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <aside class="location row">
                            <div class="col-xs-2 prr"><img src="img/mail1.png" class="img-responsive"/></div>
                            <div class="col-xs-10">
                                <?php
                                $id = $constant->getId(65);
                                $title = $constant->getTitle(65);
                                $result = $groups->getById($id);
                                $row = $conn->fetchArray($result);
                                ?>
                                <header><?php echo $title; ?></header>
                                <article>
                                    <?php echo $row['shortcontents']; ?>
                                </article>

                            </div>
                        </aside>                
                    </div>
                </div>
            </div>
        </section>
<?php */ ?>
        <!--Contact Us Section Open -->

        <div class="clearfix"></div>

        <!--Main Footer Section Open -->

        <section class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12  footer_link">
                        <div class="row list">
                            
                            <aside class="col-xs-12 col-sm-3 ">
                            <h3>Useful Links</h3>
                                <ul>
                                    
                                 
                                        <li><a href="<?php echo $row['urlname']; ?>faq" title="#"><span>&mstpos;</span>FAQ</a></li>
                                        <li><a href="<?php echo $row['urlname']; ?>?action=showsitemap" title="#"><span>&mstpos;</span>Sitemap</a></li>
                                        <li><a href="<?php echo $row['urlname']; ?>?action=feedback" title="#"><span>&mstpos;</span>Feedback</a></li>
                                        <li><a href="<?php echo $row['urlname']; ?>download" title="#"><span>&mstpos;</span>Downloads</a></li>
                                   
                                </ul>

                                <br>
                                <h3>About Us</h3>
                                <ul>
                                    <?php
                                    $id = $constant->getId(66);
                                    $result = $groups->getByParentId($id);
                                    while ($row = $conn->fetchArray($result)) {
                                        ?>
                                        <li><a href="<?php echo $row['urlname']; ?>" title="#"><span>&mstpos;</span><?php echo $row['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </aside>
                            <aside class="col-xs-12 col-sm-3 ">
                             <h3>Our Plan</h3>
                                <ul>
                                    <?php
                                    $id = $constant->getId(67);
                                    $result = $groups->getByParentId($id);
                                    while ($row = $conn->fetchArray($result)) {
                                        ?>
                                        <li><a href="<?php echo $row['urlname']; ?>" title="#"><span>&mstpos;</span><?php echo $row['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </aside>
                            <aside class="col-xs-12 col-sm-3 ">
                             <h3>Our Report</h3>
                                <ul>
                                    <?php
                                    $id = $constant->getId(68);
                                    $result = $groups->getByParentId($id);
                                    while ($row = $conn->fetchArray($result)) {
                                        ?>
                                        <li><a href="<?php echo $row['urlname']; ?>" title="#"><span>&mstpos;</span><?php echo $row['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </aside>
                          
                               

<aside class="location col-xs-12 col-sm-3">

 <div class="building">
                    <div class="text-center news-title building-title">Head Office</div>
                    <div class="build-img-wrapper text-center">
                    <img style="width:50%;" src="img/build.jpg" alt="purposed building"/></div>
                    <?php
                    $id = $constant->getId(72);
                    //$title = $constant->getTitle(72);
//                    $url = $groups->getUrlNameById($id);
                    $result = $groups->getById($id);
                    $row = $conn->fetchArray($result);
                    ?>
                 <!--   <span class="img-caption">National Life Insurance<?php// echo $title; ?></span> -->

                    <div style="color:#fff;font-size: 11px;">
<?php echo $row['shortcontents']; ?>
                    </div>
                </div>


 <?php /* ?>
        <div class="col-xs-2 prr"><img src="img/location1.png" class="img-responsive"></div>
              <h3>Main Office</h3> 
              <div class="col-xs-10">
            <header>National Life Insurance</header>
             <article>
                P.O Box: 4332<br>
                Lazimpat,&nbsp;<br> 
                Nepal  
             </article>
                            </div>
<div style="clear:both;"><br/></div>    
<!--                        
<aside>
 <h3>Follow Us</h3>                            
<div class="social">
<ul>
<li><a href="#"><img src="img/fb.png"></a></li>
<li><a href="#"><img src="img/tw.png"></a></li>
<li><a href="#"><img src="img/linked.png"></a></li>
</ul>
</div>
</aside>
-->
<?php */ ?>

</aside>



                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-xs-12  col-sm-12 col-md-12 copyright">
                        <article style="text-align:center;">
                             <hr>
                            <span >
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>board-of-directors" >Board of Directors</a> | 
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>management-team" >Management Team</a> | 
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>citizen-charter" >Citizen Charter</a> | 

                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>?action=showsitemap" >Sitemap </a> | 
                                 <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>first-policy" >First Policy </a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>branches" >Contact Us </a> | 
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>corporate-goal" >Corporate Goal </a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>notice" >Notices</a> |
                                  <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>?action=feedback" >Feedback </a> |
                                  <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>financial" >Financial Statements</a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>faq" >FAQ </a> | 
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>training-seminar-workshop" >Training, Seminar, Workshop </a>   </br>
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>contactus#location" >Location </a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>agents-info" >Insurance Agents </a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>insurance-defaulters" >Defaulters </a> |
                                <a style="color:inherit;" href="<?php echo (SITE_ADDRESS); ?>premiumcalc" >Premium Calculator </a> 
                            </span>
                            
                            
                             

                           
                        </article>
                       
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12  col-sm-12 col-md-12 copyright">
                        <article>
                    Copyright &copy; 2017::National Life Insurance Company Limited::
                            <span style='float:right; padding-right: 75px;'>  <?php 
                                $lastLogin = $users->getLastLoginDate();
                                $lastLogin = explode(' ', $lastLogin);
                                echo "Last Update  : : ". $lastLogin[0];
                            ?></span>
                        </article>
                       
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Main Footer Section Close -->

    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!--<a href="#premium" id="permiumcalc" ><img src="img/cal.png" alt="premiumcalc"/></a>-->




    <script src="js/jquery.validate.min.js"></script>P
    <script src="js/vendor/bootstrap.min.js"></script>
    <!---- start-smoth-scrolling---->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!---- start-smoth-scrolling---->
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/wowslider.js"></script>
    <script type="text/javascript"  src="js/vendor/jquery.carouFredSel-6.2.1-packed.js"></script>

    <!--for fancy box-->
    <script src="fancybox/jquery.fancybox.js"></script>
    <script src="fancybox/helpers/jquery.fancybox-buttons.js"></script>
    <script src="fancybox/helpers/jquery.fancybox-media.js"></script>
    <script src="fancybox/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="fancybox/jquery.mousewheel.pack.js"></script>


    <script type="text/javascript" language="javascript" src="js/vendor/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/vendor/jquery.touchSwipe.min.js"></script>

    <script type="text/javascript" src="js/scripts.js"></script>
    <!--<script src="js/main.php"></script>-->
    <?php include("js/main.php"); ?>

</body>
</html>
