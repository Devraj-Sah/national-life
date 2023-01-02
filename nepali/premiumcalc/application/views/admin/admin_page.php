<div class="wrapper">
	<div class="header teal">
		Admin Panel
	</div>

	<div class="container">

		<div class="nav">
			<ul>
				<li><div class="button"><a href="<?=base_url(); ?>create-policy">Create Policy</a></div></li>
			</ul>
		</div>

		<div class="content">
			<div class="policy_list">
				<?php 

					if($this->session->userdata('flash_msg_err')!='')
					{
						echo '<div class="flash_msg_err">'.$this->session->userdata('flash_msg_err').'</div>';
						$this->session->unset_userdata('flash_msg_err');
					}

					elseif($this->session->userdata('flash_msg_succ')!='')
					{
						echo '<div class="flash_msg_succ">'.$this->session->userdata('flash_msg_succ').'</div>';
						$this->session->unset_userdata('flash_msg_succ');
					}
					
				?>
				<table class="w3-table w3-bordered w3-striped" >
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Policy Name</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sn = 1;
							foreach ($policy_list as $policy): 
						?>
						<tr>
							<td><?=$sn; ?></td>
							<td><?=$policy['policy_name']; ?></td>
							<td><?php echo ($policy['active_status']==1)? 'Yes':'No'; ?></td>
							<td><a href="<?=base_url(); ?>view/policy-view/<?=$policy['id']; ?>">View</a> | <a href="<?=base_url(); ?>edit/edit-policy/<?=$policy['id']; ?>">Edit</a> | <a href="javascript:void(0);" onclick="confirm_delete('<?=base_url(); ?>delete-policy/<?=$policy['id']; ?>');">Delete</a> </td>
						</tr>
						<?php 
							$sn++;
							endforeach; 
						?>
					</tbody>
				</table>
			</div>
		</div><!--content div -->

		<div style="clear:both"></div>

	</div>
</div>

<pre>
	<?php //print_r($policy_list); ?>
	<?php //echo $policy_list[0]['id']; ?>
</pre>