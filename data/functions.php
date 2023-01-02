<?php

function formatDate($date, $type) {
  if ($type == "long") {
    $arr = explode(" ", $date);
    $arrDate = explode("-", $arr[0]);
    $arrTime = explode(":", $arr[1]);

    return date("M j, Y g:i a", mktime($arrTime[0], $arrTime[1], $arrTime[2], $arrDate[1], $arrDate[2], $arrDate[0]));
  } elseif ($type == "short") {
    $arrDate = explode("-", $date);

    return date("M j, Y", mktime(0, 0, 0, $arrDate[1], $arrDate[2], $arrDate[0]));
  }
}

function formatCallingTime($fromTime, $toTime) {
  $time = "";

  if ($fromTime > 12)
    $time .= $fromTime - 12;
  else
    $time .= $fromTime;

  if ($fromTime >= 12 && $fromTime < 24)
    $time .= " PM";
  else
    $time .= " AM";

  $time .= " to ";

  if ($toTime > 12)
    $time .= $toTime - 12;
  else
    $time .= $toTime;

  if ($toTime >= 12 && $toTime < 24)
    $time .= " PM";
  else
    $time .= " AM";

  return $time;
}

function isHome() {
  if (empty($_GET['query']) || $_GET['query'] == "home" || $_GET['query'] == "index") {
    return TRUE;
  }

  return FALSE;
}

function isLoadedFirstTime() {
  if (BASELOCATION == $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
    return TRUE;
  }

  return FALSE;
}

///////////////IMAGE CALL IMAGER FUNCTION //////////////////////////////

function imager($source, $width, $height, $fix = "") {
  list($o_width, $o_height) = getimagesize(CMS_GROUPS_DIR . $source);

  if ($width == "" && $height == "") {
    $width = $o_width;
    $height = $o_height;
  }
  if ($width == "")
    $width = floor($o_width * $height / $o_height);
  elseif ($height == "")
    $height = floor($o_height * $width / $o_width);

  $str = 'data/imager.php?file=../' . CMS_GROUPS_DIR . $source . '&amp;mw=' . $width . '&amp;mh=' . $height;
  if (!empty($fix))
    $str .= '&amp;fix';
  return $str;
}

function createMenu($parentId, $groupType) {
  global $groups;
  global $conn;
  global $pageUrlName;
  global $pageId;
  global $financialId;

  if ($parentId == 0)
    $groupResult = $groups->getVisibleByParentIdAndType($parentId, $groupType);
  else
    $groupResult = $groups->getVisibleByParentId($parentId);
  $numRows = $conn->numRows($groupResult);
  if ($numRows > 0) {
    echo "\n" . '<ul';
    if ($parentId == 0)
      echo ' class=""';
    echo ">\n";
  }
  $parentUrlName = $groups->getParentUrlName($pageId);
  $i = 0;
  while ($groupRow = $conn->fetchArray($groupResult)) {
    // if ($groupRow['linkType'] != "Link")
    {

      if ($parentId == 0) {

        if (empty($_SERVER['QUERY_STRING'])) {
          if ($i == 0) {
            echo '<li class="active"><a  ';
            $i++;
          } else {
            if ($groups->haveChild($groupRow['id']) && $groupRow['id'] != $financialId) {
              if ($groupRow['linkType'] == 'Normal Group')
                echo '<li class="has-sub"><a ';
              else
                echo '<li><a ';
            } else
              echo '<li><a ';
          }
        }
        elseif ($groupRow['linkType'] == "Link") {

          if ($groupRow['contents'] == $_GET['query']) {
            echo '<li class="active"><a  ';
          } else {
            echo '<li><a ';
          }
        } else {
          if ($groupRow['urlname'] == $parentUrlName) {
            if ($groups->haveChild($groupRow['id']) && $groupRow['id'] != $financialId)
              echo '<li class="active has-sub"><a  ';
            else
              echo '<li class="active"><a  ';
          }
          else {
            if ($groups->haveChild($groupRow['id']) && $groupRow['id'] != $financialId) {
              if ($groupRow['linkType'] == 'Normal Group')
                echo '<li class="has-sub"><a ';
              else
                echo '<li><a ';
            } else
              echo '<li><a ';
          }
        }
      }
      else {

        echo '<li><a ';
      }
      echo "href=\"" . $groupRow['urlname'] . "\" title=\"" . $groupRow['name'] . "\" >" . $groupRow['name'] . "</a>";
      ?>
      <?php
      if ($groupRow['linkType'] == "Normal Group" && $groupRow['id'] != $financialId)
        createMenu($groupRow['id'], $groupType);
      echo "\n";
      ?>
      </li>
      <?php
    }
  }
  if ($numRows > 0)
    echo '</ul>';
}

function financialMenu($parentId,$type) {
  global $groups;
  global $conn;
  global $financialId;
 

  $groupResult = $groups->getVisibleByParentIdAndType($parentId,$type);

  $numRows = $conn->numRows($groupResult);

  if ($numRows > 0) {
    echo "\n" . '<ul';
    // if ($parentId == $financialId)
    //   echo ' class="financial"';
    echo ">\n";
  }

  $i = 0;
  while ($groupRow = $conn->fetchArray($groupResult)) {
    echo '<li';

    if ($groups->haveChild($groupRow['id']) && $groupRow['linkType'] == "Normal Group")
      echo ' class="sub"><input type="checkbox" name="hasAccess[]" value="'.$groupRow['id'].'">';
    else
      echo '><input type="checkbox" name="hasAccess[]" value="'.$groupRow['id'].'">';

    echo $groupRow['name'];

    
    if ($groupRow['linkType'] == "Normal Group")
      financialMenu($groupRow['id'],$type);
    echo "\n";

    echo '</li>';
  }
  if ($numRows > 0)
    echo '</ul>';
}

function createExtraMenu($parentId, $groupType) {
  global $conn;
  global $groups;
  global $pageUrlName;
  global $pageId;
  global $financialId;
  global $_SERVER;

  $parentUrlName = $groups->getParentUrlName($pageId);
  
  $groupResult = $groups->getVisibleByParentIdAndType($parentId, $groupType);
  echo "\n<ul>\n";
  $i =0;
  $totalLinks = $conn -> numRows($groupResult);
  while ($groupRow = $conn->fetchArray($groupResult)) {
//    echo "===" . $parentUrlName . "====" . $groupRow['urlname'] . "===";
    echo '<li class="';
    
    if($groupRow['urlname'] == "products")
      echo "product";
    elseif($groupRow['urlname'] == "gallery" || $groupRow['urlname'] == "media-center")
      echo "gallery";
    
    if ($groups->haveChild($groupRow['id']) && $groupRow['id'] != $financialId && $groupRow['linkType'] == 'Normal Group') {
      echo ' has-sub';
    }
    
    if ((empty($_SERVER['QUERY_STRING']) && $i == 0) || ($groupRow['urlname'] == $parentUrlName)) {      
      echo ' current';
    }
    
    $i++;
    
    if($i == $totalLinks)
      echo " last";
   
    echo '">';
    echo "<a href=\"" . $groupRow['urlname'] . "\" title=\"" . $groupRow['name'] . "\" >" . $groupRow['name'] . "</a>";

    if ($groups->haveChild($groupRow['id']) && $groupRow['id'] != $financialId && $groupRow['linkType'] == 'Normal Group') {
      echo '<div class="dropdownWrap">';
      echo '<div class="midcrv">';
      echo '<div class="lhssection">';
      $result = $groups->getByParentId($groupRow['id']);
      echo '<ul>';
      $arr = array();
      $arrLinkType = array();
      while ($row = $conn->fetchArray($result)) { // Level 1
        echo '<li><a href="' . $row['urlname'] . '" title="' . $row['name'] . '">' . $row['name'] . '</a></li>';
        $arr[] = $row['id'];
        $arrLinkType[] = $row['linkType'];
      }
      echo '</ul>';
      echo '</div>';

      if (count($arr) > 0) {
        echo '<div class="rhssection">';
        foreach ($arr as $key => $id) {
          if ($arrLinkType[$key] == "Normal Group") {
            $result = $groups->getByParentId($id);
            if ($conn->numRows($result) > 0) {

              echo '<div class="innerNavs">';
              echo '<div class="innerNavContainer">';
              echo '<ul>';

              $arr1 = array();
              $arrLinkType1 = array();
              while ($row = $conn->fetchArray($result)) {
                echo '<li><a href="' . $row['urlname'] . '" title="' . $row['name'] . '">' . $row['name'] . '</a></li>';
                $arr1[] = $row['id'];
                $arrLinkType1[] = $row['linkType'];
              }
              echo '</ul>';
              echo '<div class="right_banner">';

              if (count($arr1) > 0) {
                foreach ($arr1 as $key1 => $id1) {
                  if ($arrLinkType1[$key1] == "Normal Group") {
                    $result1 = $groups->getByParentId($id1);
                    if ($conn->numRows($result1) > 0) {
                      echo '<div class="childNavs">';
                      echo '<ul>';

                      while ($row1 = $conn->fetchArray($result1)) {
                        echo '<li><a href="' . $row1['urlname'] . '" title="' . $row1['name'] . '">' . $row1['name'] . '</a></li>';
                      }
                      echo '</ul>';
                      echo '</div>';
                    }
                  }
                }
              }
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          }
        }
        echo '</div>';
      }

      echo '</div>';
      echo '</div>';
    }
    echo '</li>';
  }
  echo '</ul>';
}
