<div class="container">
    <div class="col-xs-12 cms-content">
        <div class="row">
            <div class='col-xs-12'>
                <?php include("includes/breadcrumb.php"); ?>
            </div>
        </div>
    </div>
</div>
<div class="product-rest-wrapper">
    <div class="black-bg">
        <div>	
            <div class="container innerPage">


                <?php
                $i = 0;
                $pagename = $pageUrlName . "/";
                $sql = "SELECT * FROM groups WHERE parentId = $pageId ORDER BY id DESC";
                $newsql = $sql;


                $result = mysql_query($sql);

                while ($galleryRow = $conn->fetchArray($result)) {
                    ++$i;
                    ?>
                    <div style="margin-bottom:20px;" class="col-xs-6 col-sm-3">
                        <a rel="" class="cmsGallery thumbnail" data-fancybox-group="gallery" href="<?php echo CMS_GROUPS_DIR . $galleryRow['image'] ?>" title="<?php echo $galleryRow['shortcontents']; ?>" style="display:block;" >
                            <img class="img-responsive" src="<?php echo CMS_GROUPS_DIR . $galleryRow['image']; ?>" border="0" alt="<?= $galleryRow['shortcontents']; ?>"  title="<?= $galleryRow['shortcontents']; ?>" />
                            <span class="img-caption"><?= $galleryRow['shortcontents']; ?></span>
                        </a>
                    </div>



                    <?php
                    if ($i % 4 == 0) {
                        ?>
                        <div style="clear:both"></div>

                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
