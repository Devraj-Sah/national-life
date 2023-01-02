<?php
if (file_exists(CMS_GROUPS_DIR . $pageImage) && !empty($pageImage)) {
    ?>
    <div class="inner-banner-img">
        <img src="<?php echo CMS_GROUPS_DIR . $pageImage; ?>" alt="">
    </div>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 cms-content">
            <div class="row">
                <div class='col-xs-12'>
                    <?php include("includes/breadcrumb.php"); ?>
                </div>

                <div class='col-xs-12'>
                    <div class='inner-content-wrapper'>
                        <div class="inner-content-title"><?php echo $pageName; ?></div>
                        <div class="inner-content">
                            <?php echo $pageContents; ?>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($groups->haveChild($pageId)) {
    ?>


    <div class="sublinks-wrapper">
        <div class="container">
            <div class="row">

                <!--for the sub links which are not files-->
                <div class="col-xs-12">
                
                        <?php                        
                        if($pageId == $financialId) {
                          financialMenu($pageId);                          
                        } else {  
                          $result = $groups->getByParentId($pageId);
//                        for sublinks with number equals or more than 3
                          
                        if ($conn->numRows($result) >= 3) {
                            $i = 1;
                            $counter = 0;

//                            for those which have valid image

                            while ($row = $conn->fetchArray($result)) {

//                                checking if image exits or not
                                if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                    $check = true;
                                } else {
                                    $check = false;
                                }


                                if ($row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery' && $check) {
                                    ?>
                                    <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-4 sublinks">
                                        <img class="sublinks-image bublnkimg" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                        <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                        <div class="sublinks-content">
                                            <?php// echo strip_tags($row['contents']); ?>
                                        </div>
                                    </a>
                                    <?php
                                    if ($i % 3 == 0) {
                                        ?>
                                        <div class="clearfix hidden-xs"></div>
                                        <?php
                                    }$i++;
                                    $counter++;
                                }
                            }
                            if ($counter > 0)
                                echo "<div style='border-bottom:1px solid #ccc;margin-bottom:20px;' class='clearfix hidden-xs'></div>";

//                            for those which have not valid image
                            $i = 1;
                            $result = $groups->getByParentIdNotice($pageId);
                            while ($row = $conn->fetchArray($result)) {

                                if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                    $check = false;
                                } else {
                                    $check = true;
                                }


                                if ($row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery' && $check) {
                                    ?>
                                    
                                        <div class="text-capitalize "> <a href="<?php echo $row['urlname']; ?>" ><span><?php echo($i); ?>. </span>  <?php echo strip_tags($row['name']); ?></a></div>
                                      <!--  <div class="sublinks-content"> -->
                                    <?php //echo strip_tags($row['contents']); ?>
                                   <!--     </div> -->
                                    
                                    <?php
                                  ////************* My Edit: Madhu**************************/

                                   // if ($i % 3 == 0) {
                                        ?><br>
                                        <div class="clearfix hidden-xs"></div>
                                        <?php
                                   // }
                                        $i++;
                                }
                            }
                        } else if ($conn->numRows($result) == 2) {     // for sublinks with number equals to 2
                            $i = 1;


                            while ($row = $conn->fetchArray($result)) {



                                if ($row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery') {
                                    ?>
                                    <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                        <?php
                                        if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                            ?>
                                            <img class="sublinks-image" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                            <?php } ?>
                                        <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                        <div class="sublinks-content">
                                    <?php echo strip_tags($row['contents']); ?>
                                        </div>
                                    </a>
                                    <?php
                                    if ($i % 2 == 0) {
                                        ?>
                                        <div class="clearfix hidden-xs"></div>
                                        <?php
                                    }$i++;
                                }
                            }
                        } else if ($conn->numRows($result) == 1) {   // for sublinks with number equals to 1
                            while ($row = $conn->fetchArray($result)) {

                                if ($row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery') {
                                    ?>
                                    <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 sublinks">
                                        <?php
                                        if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                            ?>
                                            <img class="sublinks-image" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                            <?php } ?>
                                        <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                        <div class="sublinks-content">
                                    <?php echo strip_tags($row['contents']); ?>
                                        </div>
                                    </a>
                                    <?php
                                }
                            }
                        }
                        }
                        ?>
                        <!--// for main gallery  and video gallery page of the site only i.e. for Gallery section containing photo gallery and video gallery -->
                        <?php
                        $result = $groups->getByParentId($pageId);
                        while ($row = $conn->fetchArray($result)) {
                            if (($row['linkType'] == 'Gallery' && $row['urlname'] == 'photo-gallery' ) || ( $row['linkType'] == 'Video Gallery' && $row['urlname'] == 'video-gallery' )) {
                                ?>
                                <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                    <?php
                                    if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                        ?>
                                        <img class="sublinks-image" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                        <?php } ?>
                                    <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                    <div class="sublinks-content">
                                <?php echo strip_tags($row['contents']); ?>
                                    </div>
                                </a>
                                <?php
                                if ($i % 2 == 0) {
                                    ?>
                                    <div class="clearfix hidden-xs"></div>
                                    <?php
                                }$i++;
                            }
                        }
                        ?>


                                  
                </div>


                <!--for the sub links which are files-->

                <div class="col-xs-12">
                    <div class="row">
                        <?php
                        $result = $groups->getByParentId($pageId);
                        $i = 1;
                        $counter = 0;
                        while ($row = $conn->fetchArray($result)) {
                            if ($row['linkType'] == 'File') {
                                ?>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="sublinks-file">
                                        <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                            <?php if (!empty($row['shortcontents'])) { ?>
                                            <div class="sublinks-content">
                                            <?php echo strip_tags($row['shortcontents']); ?>
                                            </div>
            <?php } ?>
                                        <a class="download-link" href="<?php echo $row['urlname']; ?>" target="_blank"><?php echo $row['name']; ?></a>
                                    </div>
                                </div>
                                <?php
                               // if ($i % 3 == 0) {
                                    ?>
                                    <div class="clearfix hidden-xs"></div>
                                    <?php
                              //  }$i++;
                                $counter++;
                            }
                        }
                        if ($counter > 0)
                            echo "<div style='border-top:1px solid #ccc;margin-top:-10px;' class='clearfix hidden-xs'></div>";
                        ?>
                    </div>
                </div>

                <!--for sub links which are gallery-->
                <div class="container">
                    <div class="col-xs-12">
                        <div class="row">
                            <?php
                            $result = $groups->getByParentId($pageId);
                            while ($row = $conn->fetchArray($result)) {
                                if (($row['linkType'] == 'Gallery' && $row['urlname'] != 'photo-gallery' ) || ( $row['linkType'] == 'Video Gallery' && $row['urlname'] != 'video-gallery')) {
                                    ?>
                                    <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                        <?php
                                        if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                            ?>
                                            <img class="sublinks-image diswhichrgall" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                            <?php } ?>
											
                                        <div class="inner-link-title">
										
		<?php echo strip_tags($row['name']); ?>
										
										</div>
										
                                        <div class="sublinks-content">
                                    <?php echo strip_tags($row['contents']); ?>
                                        </div>
                                    </a>
                                    <?php
                                    if ($i % 2 == 0) {
                                        ?>
                                        <div class="clearfix hidden-xs"></div>
                                        <?php
                                    }$i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
}
$result1 = $groups->getByParentId($pageParentId);

if ($groups->haveChild($pageParentId) && $pageParentId != 0 && $conn->numRows($result1) > 1) {
    ?>


    <hr class="hr">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 cms-content">
                <div class="row">
                    <!--for the siblings which are not file and not same as selected one-->
                    <div class='col-xs-12'>
                        <div class="row">
                            <?php
                            $result = $groups->getByParentId($pageParentId);
                            if ($conn->numRows($result) - 1 >= 2) {
                                $i = 1;
                                $counter = 0;
//                                for having image

                                while ($row = $conn->fetchArray($result)) {

                                    //   checking if image exits or not
                                    if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                        $check = true;
                                    } else {
                                        $check = false;
                                    }

                                    if ($pageId != $row['id'] && $row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery' && $check) {
                                        ?>
                                        <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                            <img class="sublinks-image" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/>
                                            <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                            <div class="sublinks-content">
                                        <?php echo strip_tags($row['contents']); ?>
                                            </div>
                                        </a>
                                        <?php
                                        if ($i % 2 == 0) {
                                            ?>
                                            <div class="clearfix hidden-xs"></div>
                                            <?php
                                        }$i++;
                                        $counter++;
                                    }
                                }

//                                which have not image
                                if ($counter > 0)
                                    echo "<div style='border-bottom:1px solid #ccc;margin-bottom:20px;' class='clearfix hidden-xs'></div>";
                                $i = 1;
                                $counter = 0;
                                $result = $groups->getByParentId($pageParentId);
                                while ($row = $conn->fetchArray($result)) {

                                    //   checking if image exits or not
                                    if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                        $check = false;
                                    } else {
                                        $check = true;
                                    }

                                    if ($pageId != $row['id'] && $row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery' && $check) {
                                        ?>
                                        <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                            <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                            <div class="sublinks-content">
                                        <?php echo strip_tags($row['shortcontents']); ?>
                                            </div>
                                        </a>
                                        <?php
                                        if ($i % 2 == 0) {
                                            ?>
                                            <div class="clearfix hidden-xs"></div>
                                            <?php
                                        }$i++;
                                        $counter++;
                                    }
                                }
                                if ($counter > 0)
                                    echo "<div style='border-bottom:1px solid #ccc;margin-bottom:20px;' class='clearfix hidden-xs'></div>";
                            } else if ($conn->numRows($result) - 1 == 1) {

                                while ($row = $conn->fetchArray($result)) {
                                    if ($pageId != $row['id'] && $row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery') {
                                        ?>
                                        <a href="<?php echo $row['urlname']; ?>" class="col-xs-12  sublinks">
                                                <?php
                                                if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                                    ?>
                                                <div class="text-center">   <img class="sublinks-image" src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" alt=""/></div>
                                        <?php } ?>
                                            <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                            <div class="sublinks-content">
                                        <?php echo strip_tags($row['contents']); ?>
                                            </div>
                                        </a>
                <?php
            }
        }
    }
    ?>

                        </div>
                    </div>
                    <!--for the sib-links which are files-->

                    <div class="col-xs-12">
                        <div class="row">
    <?php
    $result = $groups->getByParentId($pageParentId);
    $i = 1;
    while ($row = $conn->fetchArray($result)) {
        if ($row['linkType'] == 'File' && $pageId != $row['id']) {
            ?>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="sublinks-file">
                                            <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
                                    <?php if (!empty($row['shortcontents'])) { ?>
                                                <div class="sublinks-content">
                                        <?php echo strip_tags($row['shortcontents']); ?>
                                                </div>
                                    <?php } ?>
                                            <a class="download-link" href="<?php echo $row['urlname']; ?>" target="_blank"><?php echo $row['name']; ?></a>
                                        </div>
                                    </div>
                                    <?php
                                    if ($i % 3 == 0) {
                                        ?>
                                        <div class="clearfix hidden-xs"></div>
                <?php
            }$i++;
        }
    }
    ?>
                        </div>
                    </div>


                    <!--for the siblinks which are gallery-->


                    <div class="col-xs-12">
                        <div class="row">
                                <?php
                                $result = $groups->getByParentId($pageParentId);
                                while ($row = $conn->fetchArray($result)) {
                                    if (($row['linkType'] == 'Gallery' && $row['urlname'] != 'photo-gallery' ) || ( $row['linkType'] == 'Video Gallery' && $row['urlname'] != 'video-gallery')) {
                                        ?>
                                    <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6 sublinks">
                                            <?php
                                            if (file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image'])) {
                                                ?>
                                            <img class="sublinks-image" src="<?php echo $row['image']; ?>" alt=""/>
                                    <?php } ?>
                                        <div class="inner-link-title"><?php echo strip_tags($row['name']); ?></div>
										
										
										
                                        <div class="sublinks-content">
                                    <?php echo strip_tags($row['contents']); ?>
                                        </div>
                                    </a>
                                    <?php
                                    if ($i % 2 == 0) {
                                        ?>
                                        <div class="clearfix hidden-xs"></div>
                <?php
            }$i++;
        }
    }
    ?>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>
            <?php } ?>
<div class="container">
    <div class="col-xs-12">
        <?php
        if ($pageUrlName == "contact-us" || $pageUrlName == "contact" || $pageUrlName == "contactus") {
            ?>
            <div style="border-top: 2px solid #555555;margin-top: 20px; padding: 10px;">
            <?php include ('includes/inquiry.php'); ?>
                <div class="clearfix"></div>
                <!--                <?php include('includes/map.php'); ?>                     -->
            </div>
            <?php
        }
        $mainParentId = 0;
        $groups->getMainParent($pageId);

        $parentUrl = $groups->getUrlNameById($mainParentId);
        if ($parentUrl == 'products') {
            ?>
        
         <a href="http://nationallife.com.np/premiumcalc/" target="_blank" class="btn btn-default pull-left">PREMIUM CALCULATOR</a>
        <br />
        <div class="clearfix"></div>
                <?php
}
?>
    </div>
</div>
