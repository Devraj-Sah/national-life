<style>
    .img-caption{
        display: block;
        height: 33px;
        overflow: hidden;
        text-transform: capitalize;
        text-align: center;
    }
    #paging{
        font-family: 'RalewayRegular','Verdana','HelveticaNeue', sans-serif;
    }
    .selected{
        color: red;
    }
</style>

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
        <div class="container innerPage">

            <?php
            $i = 0;
            $pagename = $pageUrlName . "/";
            $sql = "SELECT * FROM groups WHERE parentId = '$pageId' ORDER BY id DESC";

           
            $result = mysql_query($sql);

            while ($row = $conn->fetchArray($result)) {
                $i++;
                ?>
                <div style="margin-bottom:20px;" class="col-xs-6 col-sm-3">
                    <!-- gall main starts -->
                    <a href="<?php echo $row['contents']; ?>" data-fancybox-group="video-gallery" class="cmsVideo thumbnail"><img src="<?php echo getYouTubeImage($row['contents'], "small"); ?>" width="100%" height="200" alt="<?php echo $row['title']; ?>"></a>       
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