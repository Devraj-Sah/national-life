<style>
    h5>a{
        width: 75%;
        display: inline-block;
        overflow: hidden;
        font-size: 18px;
        text-transform: capitalize;
    }
    h5>a:hover{
        color: #D7CC0F;
    }
    h5>i{
        font-weight: 300;
        font-size: 13px;
        color: #D0C500;
    }
</style>
<div class="container"> 
    <div class="row">
        <div class="col-xs-12 cms-content">
            <?php
            include("includes/breadcrumb.php");
            $pagename = $pageUrlName . "/";

            $sql = "SELECT * FROM groups WHERE parentId = '$pageId' ORDER BY onDate DESC, id DESC";

            $newsql = $sql;

            $limit = LISTING_LIMIT;

            $return = Pagination($sql, "");

            $arr = explode(" -- ", $return);

            $start = $arr[0];
            $pagelist = $arr[1];
            $count = $arr[2];

            $newsql .= " LIMIT $start, $limit";

            $result = mysql_query($newsql);

            while ($listRow = $conn->fetchArray($result)) {
                $arrDate = explode("-", $listRow['onDate']);
                ?>
                <div style="padding:10px 0;  border-bottom: 1px solid rgba(203, 191, 9, 0.22);margin-top: 50px;">
                    <h5 style="font-weight: bold;  margin-bottom:11px;">
                        <a  href="<?php echo $listRow['urlname']; ?>"><?php echo $listRow['name']; ?></a>
                        <i class="pull-right">
                            Updated Date : <?php echo date("M d, Y", mktime(0, 0, 0, $arrDate[1], $arrDate[2], $arrDate[0])); ?>
                        </i>
                    </h5><!-- end of listTitle -->

                    <div style="max-height: 122px;
                         overflow: hidden; border-left: 10px solid rgba(255, 241, 0, 0.33);
                         padding: 0 15px;">

                        <?php
                        if (file_exists(CMS_GROUPS_DIR . $listRow['image']) && !empty($listRow['image'])) {
                            ?>
                            <img style="float: left;
                                 margin-right: 15px;
                                 margin-top: 0px;
                                 max-height: 100%;" src="<?php echo CMS_GROUPS_DIR.$listRow['image']; ?>" alt="<?php echo $listRow['name']; ?>" />
                             <?php } ?>
                             <?php echo nl2br($listRow['shortcontents']); ?>
                    </div>
                    <div class="clearfix">
                        <br>
                        <a class="pull-right readmore" href="<?php echo $listRow['urlname']; ?>">Read more &Implies;</a>
                        <!--<a class="readmore" href="<?php echo $row['urlname']; ?>">Step ahead &Implies;</a>-->
                    </div>
                    <div style="clear:both;"></div>
                </div><!-- end of listRow -->
                <?php
            }
            if ($count > $limit)
                echo $pagelist;
            ?>
        </div>

    </div>

</div>