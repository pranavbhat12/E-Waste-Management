<?php include('header_user.php');?>
<div class="container">
	<br>
	  <ol class="breadcrumb" style="width: 280px;">
	        <li class="breadcrumb-item"><a href="#">User</a></li>
	        <li class="breadcrumb-item"><a href="#">Profile</a></li>
	        <li class="breadcrumb-item active">Your Donations</li>
	 </ol>
	 <br>
	 <h2 class="text-primary">Your Donations</h2>
	    <br>
	    <br>
	    <table class="table">
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Name</th>
				<th>Date</th>
				<th>Details</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($donations)): ?>
			<?php $count = $this->uri->segment(3)?>
			<?php foreach($donations as $donations): ?>
			<tr>
				<td><?= ++$count ?></td>
				<td><?= $donations->e_name?></td>
				<td><?= date('d M y H:i:s',strtotime($donations->date)) ?></td>
				<td><?= anchor("user/donationDetails/{$donations->e_id}",'More Details',['class'=>'btn btn-warning']) ?></td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
				<tr>
					<td colspan="3">No records found.</td>
				</tr>
			<?php endif;?>
		</tbody>
	</table>
	<?= $this->pagination->create_links();?>
</div>
<?php include('footer.php');?>