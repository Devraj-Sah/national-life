<?php
function Pagination($content, $type)
{
	global $pagename;
	
	if($type == "content")
	{
		if(!isset($_GET['page'])){
		 $curpage = 1;
		}
		else {
		 $curpage = $_GET['page'];
		}
		
		$arr = explode('<hr />', $content);
		
 		$pages = count($arr);
		$count = $pages;
	}
	else
	{		
		global $limit;
		
		$rsord = mysql_query($content);
		
		if($rsord)
		{
		 $cntorder = mysql_num_rows($rsord);
		}
			
		if (!isset($limit))
			$limit = 10;	// no of records to be displayed in each page
		
		$count = $cntorder;
		
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
  	
		if ((!isset($_GET['page'])) || ($page == "1"))
		{
		 $start = 0;
		 $curpage = 1;
		}
		else
		{ 
		 $start = ($_GET['page']-1) * $limit;
		 $curpage = $_GET['page'];
		}
	}

	 
	$pageList  = "<div style='text-align:center' id='pAging'>";
  
	$pageList .= "<div style='padding-bottom:5px;'>Results $count : You are at page $curpage of $pages</div>";
  if (($curpage-1) > 0){
   $pageList .= "<a href='".$pagename."page/".($curpage-1)."' title='Previous Page' class='pAging'>&laquo; Prev</a>&nbsp;";
  }
	
	for($i=1; $i<=$pages; $i++)
	{
		if($curpage == $i)
			$pageList .= ' <span class="selected">'. $i . ' </span>';
		else
			$pageList .= ' <a href="'. $pagename .'page/'. $i .'" class="pAging">'. $i . '</a> ';
	}
	
  if (($curpage+1) <= $pages){
   $pageList .= "<a href='".$pagename."page/".($curpage+1)."' title='Next Page' class='pAging'>Next &raquo;</a>";
  }
  $pageList .= "</div>\n";
	
	if($type == "content")
	{
		echo $arr[($curpage - 1)];
		if($pages > 1)
	  	echo $pageList;
	}
	else
	{
		return $start . " -- " . $pageList . " -- " . $count;
	}
}
//paging ends

?>