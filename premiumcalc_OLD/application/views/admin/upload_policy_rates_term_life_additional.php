<script type="text/javascript">
$(document).ready(function() {
	
	//fires when save button is clicked
	$("#create").click(function(event) {
		$("#upload_rate").submit();
	});

});

</script>

<div class="wrapper">
	<div class="header teal">
		Admin Panel
	</div>

	<div class="container">

		<div class="nav">
			<ul>
				<li><div class="button"><a href="<?=base_url(); ?>view/policy-view/<?=$policy['id']; ?>">Cancel</a></div></li>
			</ul>
		</div>

		
		<div class="content">
			<div class="edit-policy" style="border:0px solid #000;">
				<ul>
					<fieldset>
						<legend>Policy Rate File For Term Life Additional Benefit</legend><br>
						<label>Policy Rate File (old) : </label><a href="<?=base_url();?>sysfiles/policy_rates_term_life_additional/policy_rate_term_life_additional_<?=$policy['policy_id']; ?>.csv">Click here to download !!</a><br><br><br>
						<label>Policy Rate File (Sample) : </label><a href="<?=base_url();?>sysfiles/sample/sample_rate.csv">Click here to download !!</a><br><br>
					</fieldset><br>
					 
					<div class="err_msg" id="err_main"></div>
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div><br>

					<form method="POST" enctype="multipart/form-data" action="" id="upload_rate" name="upload_rate" >
						<fieldset>
							<legend>Upload Policy Rate For Term Life Additional Benefit</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li><br>
							<li>
								<label>Rate Per For Primary Rate <span class="req">*</span> : </label>	
								<input type="text" name="rate_per" id="rate_per" value="" placeholder="eg 1000 or 10000" size="25"/>
							</li>
							<li>
								<label>Select File <span class="req">*</span> : </label>
								<input type="file" name="userfile" id="rate_file1" value="" size=""/><br><br>
								<div class="special_msg">[ Only CSV Files are allowed eg:- example.csv ]</div>
							</li>
							<li>
								<br><input type="button" id="create" name="create" value=" Save " class="button_i"/> 
							</li>
						</fieldset>
					</form>
				</ul>
				<fieldset>
					<legend>Policy Rates Per (<?=$policy_rate[0]['rate_per'];?>)</legend>
					<table class="w3-table w3-bordered w3-striped" >
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Entery Age</th>
							<th>Policy Term</th>
							<th>Rate</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($policy_rate != false)
						{
							$sn = 1;
							foreach ($policy_rate as $rate): 
								echo '<tr>';
								echo '<td>'.$sn.'</td>';
								echo '<td>'.$rate['entry_age'].'</td>';
								echo '<td>'.$rate['policy_term'].'</td>';
								echo '<td>'.$rate['rate'].'</td>';
								echo '</tr>';
								$sn++;
							endforeach; 
						}
						else
						{
							echo '<tr colspan="4"><td><div class="err_msg" style="font-size:16px;">Please Set Policy Rate For Term Life Additional Benefit</div></td></tr>';
						}
						?>
					</tbody>
				</table>
				</fieldset>
			</div>
		</div><!--content div -->
		<div style="clear:both"></div>
	</div>
</div>


