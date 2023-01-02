<?php

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

class Pager {

    var $pagename;
    var $shownum;
    var $showprevnum;

    function findStart($page, $limit) {
        if ((!isset($page)) || ($page == "1")) {
            $start = 0;
            $page = 1;
        } else {
            $start = ($page - 1) * $limit;
        }
        return $start;
    }

//function findStart ends

    function findPages($count, $limit) {
        $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
        return $pages;
    }

//function findPages ends

    function pageList($curpage, $pages) {
        $page_list = "";
        $page_list_image = "";


        if (($curpage != 1) && ($curpage))
            $page_list .= "<a href='" . $this->pagename . "page=1'>First</a>";
        else
            $page_list .= '<span class="disabled">First</span>';


        if (($curpage - 1) > 0) {
            $page_list .= "<a href=" . $this->pagename . "page=" . ($curpage - 1) . " class=paging>Prev</a>";
            $page_list_image .= "<a href=" . $this->pagename . "page=" . ($curpage - 1) . " class=paging>Previous</a>";
        } else {
            $page_list .= '<span class="disabled">Prev</span>';
            $page_list_image .= '<span class="disabled">Previous</span>';
        }

        $printed = false;
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $curpage) {
                $page_list .= "<span class='selected'>" . $i . "</span>";
                $page_list_image .= "<span class='selected'>" . $i . "</span>";
            } elseif (($i <= $this->showprevnum) || ($i > ($pages - $this->showprevnum)) || ($i >= $curpage - $this->shownum && $i <= $curpage) || ($i <= $curpage + $this->shownum) && $i >= $curpage) {

                if (!$printed && (($i > $this->showprevnum && $curpage > ($this->showprevnum + $this->shownum + 1) && $i <= ($curpage - $this->shownum)) || ($i > $curpage && $curpage < ($pages - $this->showprevnum - $this->shownum) && $i > ($curpage + $this->shownum)))) {
                    $page_list .= "<span>...</span>";
                    $page_list_image .= "<span>...</span>";
                    $printed = true;
                }
                else
                    $printed = false;

                $page_list .= "<a href=" . $this->pagename . "page=" . $i . " class=paging>" . $i . "</a>";
                $page_list_image .= "<a href=" . $this->pagename . "page=" . $i . " class=paging>" . $i . "</a>";
            }
            /*

              if($i == ($pages - ($this->showprevnum)))
              $printed = false;

              if(($curpage > ($this -> shownum + $this -> showprevnum+1) && $i > $this -> showprevnum) && !$printed){
              $page_list .= "<span>...</span>";
              $printed = true;
              }
             */
            $page_list .= "";
        }
        if (($curpage + 1) <= $pages) {
            $page_list .= "<a href=" . $this->pagename . "page=" . ($curpage + 1) . " class=paging>Next</a>";
            $page_list_image .= "<a href=" . $this->pagename . "page=" . ($curpage + 1) . " class=paging>Next</a>";
        } else {
            $page_list .= '<span class="disabled">Next</span>&nbsp;';
            $page_list_image .= '<span class="disabled">Next</span>&nbsp;';
        }

        if (($curpage != $pages) && ($pages != 0)) {
            $page_list .= " <a href=" . $this->pagename . "page=" . $pages . " class=paging>Last</a>";
        }
        else
            $page_list .= '<span class="disabled">Last</span>';

        $page_list .= "\n";
        return $page_list;
    }

//function pageList ends
}

//paging ends
//------for listing orders of this customer
//$db=new Dbconn();

$sqlord = $sql;
$rsord = mysql_query($sqlord);
if ($rsord) {
    $cntorder = mysql_num_rows($rsord);
}
$p = new Pager();
$p->pagename = $pagename;
$p->shownum = $shownum;
$p->showprevnum = $showprevnum;

if (!isset($limit))
    $limit = 10; // no of records to be displayed in each page

$count = $cntorder;
$MaxPage = $cntorder;
$pages = $p->findPages($count, $limit);

$start = $p->findStart($page, $limit);

/* if ((!isset($page)) || ($page == "1"))
  {
  $result = mysql_query($sql." LIMIT ".$start.", ".$limit);
  }
  else
  {
 */
$sql.=" LIMIT " . $start . ", " . $limit;
$result = mysql_query($sql);
//}

$pagelist = $p->pageList($page, $pages);
?>