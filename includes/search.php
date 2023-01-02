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
      
      if (empty($_POST['key']) && !isset($_GET['page']))
      {
        echo "<i>Please Type a Search Key!!<i>";
      }
      else
      {

        $pagename = "search/";
        if (isset($_SESSION['key']))
        {
          if (isset($_POST['key']))
          {
            $key = cleanQuery($_POST['key']);
            $_SESSION['key'] = $key;
          }
          else
            $key = cleanQuery($_SESSION['key']);
        }
        else
        {
          $key = cleanQuery($_POST['key']);
          $_SESSION['key'] = $key;
        }

        $sql = "SELECT * FROM groups WHERE (name like '%$key%' 
					OR urlname like '%$key%'
					OR shortcontents like '%$key%'
					OR contents like '%$key%'
					OR pageTitle like '%$key%'
					OR pageKeyword like '%$key%'
					OR pageDescription like '%$key%') 
					AND (name !='' AND (shortcontents != '' OR contents != '')) 
					ORDER BY onDate DESC, id DESC
					";

        $newsql = $sql;

        //$limit = LISTING_LIMIT;
        $limit = 12;
        $return = Pagination($sql, "");

        $arr = explode(" -- ", $return);

        $start = $arr[0];
        $pagelist = $arr[1];
        $count = $arr[2];

        $newsql .= " LIMIT $start, $limit";

        $result = mysql_query($newsql);
        ?>
        <ol class="breadcrumb"><li style="color:#fff;">Showing Result for <?php echo "<i style=\"color:#fff;\">'" . $key . "'</i>"; ?></li></ol>
        <?php
        while ($listRow = $conn->fetchArray($result))
        {
          $arrDate = explode("-", $listRow['onDate']);
          //if(!empty($listRow['name']) && (!empty($listRow['shortcontents']) || !empty($listRow['contents'])))
          //{
          ?>
          <div style="padding:10px 0;  border-bottom: 1px solid rgba(203, 191, 9, 0.22);margin-top: 50px;">
            <h5 style="font-weight: bold;  margin-bottom:11px;">
              <a style="width: 75%;
                 display: inline-block;
                 overflow: hidden;" href="<?php echo $listRow['urlname']; ?>"><?php echo $listRow['name']; ?></a>
              <i class="pull-right">
                Updated Date : <?php echo date("M d, Y", mktime(0, 0, 0, $arrDate[1], $arrDate[2], $arrDate[0])); ?>
              </i>
            </h5><!-- end of listTitle -->



            <div style="max-height: 122px;
                 overflow: hidden; border-left: 10px solid rgba(255, 241, 0, 0.33);
                 padding: 0 15px;">
                 <?php
                 if (file_exists(CMS_GROUPS_DIR . $listRow['image']) && !empty($listRow['image']))
                 {
                   ?>
                <img style="float: left;
                     margin-right: 10px;
                     margin-top: 4px;
                     max-width: 200px;
                     max-height: 160px;" src="<?php echo imager($listRow['image'], 150, "", "fix"); ?>" alt="<?php echo $listRow['title']; ?>" />
                   <?php } ?>
                   <?php
                   if (empty($listRow['shortcontents']))
                     echo substr(strip_tags($listRow['contents']), 0, 180);
                   else
                     echo substr(strip_tags(nl2br($listRow['shortcontents'])), 0, 180);
                   ?> </div>
            <div style="clear:both;"></div>
          </div><!-- end of listRow -->

          <?php
        }
        // }
      }
      if ($count > $limit)
        echo '<div class="clearfix"></div>' . $pagelist;
      ?>
    </div>
   
  </div></div>


