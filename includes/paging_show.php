<div>	
  <div class="galPage"><?php echo $pagelist; ?></div>
	<div >
	<?php 
	if(($start+$limit)<= $cntorder)
		$final = $start+$limit;
	else
		$final = $cntorder;
	?>
	Results : <?php echo $start+1 . " - " . $final; ?> of <?php echo $cntorder; ?>
  </div>
  <div class="clear"></div>
</div>
