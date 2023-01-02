<?php
$listResult = $groups->getById($pageId);
$listRow = $conn->fetchArray($listResult);

$pageResult = $groups->getById($pageParentId);
$pageRow = $conn->fetchArray($pageResult);

$navNextResult = $groups->getNextResult($pageId);
$navNextRow = $conn->fetchArray($navNextResult);

$navPreviousResult = $groups->getPreviousResult($pageId);
$navPreviousRow = $conn->fetchArray($navPreviousResult);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 cms-content">
            <?php
            include("includes/breadcrumb.php");
            ?>
            <!--      <div class="clearfix" style="margin-bottom: 20px;">
                    <div style="float: right; margin-right: 10px; height: 30px;"> <a href="<?php echo $navNextRow['urlname']; ?>" class="pAging">Next &raquo;</a> </div>
                    <div style="float: right; height: 30px;" > <a href="<?= $navPreviousRow['urlname']; ?>" class="pAging">&laquo; Previous</a> </div>
                  </div>-->
            
            
             <div class='inner-content-wrapper'>
                <div class="inner-content-title"><?php echo $listRow['name']; ?></div>
                  
            </div>
            
            <?php
            if (file_exists(CMS_GROUPS_DIR . $listRow['image']) && !empty($listRow['image'])) {
                ?>
                <div align="center" style="text-align:center; padding-top:10px;"><img src="<?php echo CMS_GROUPS_DIR . $listRow['image']; ?>" />
                    <div style="clear:both"></div>
                </div>
                <br />
            <?php } ?>

           

            <div class="listContent">
                <?php echo $listRow['contents']; ?>
            </div>
        </div>

    </div>
</div>
<?php
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
        while ($row = $conn->fetchArray($result)) {
            if ($pageId != $row['id'] && $row['linkType'] != 'File' && $row['linkType'] != 'Gallery' && $row['linkType'] != 'Video Gallery') {
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
                    </div>


                </div>

            </div>

        </div>
    </div>
<?php } ?>


