<?php include('header_user.php');?>
<div class="container">
	<br>
	  <ol class="breadcrumb" style="width: 250px;">
	        <li class="breadcrumb-item"><a href="#">User</a></li>
	        <li class="breadcrumb-item"><a href="#">Profile</a></li>
	        <li class="breadcrumb-item active">Your Orders</li>
	 </ol>
	 <br>
	 <h2 class="text-primary">Your Orders</h2>
	    <br>
	    <br>
	    <table class="table">
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Amount</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($orders)): ?>
			<?php $count = $this->uri->segment(3)?>
			<?php foreach($orders as $orders): ?>
			<tr>
				<td><?= ++$count ?></td>
				<td>₹<?= $orders->amount ?></td>
				<td><?= date('d M y H:i:s',strtotime($orders->date)) ?></td>
				<td><?= anchor("user/orderDetails/{$orders->o_id}",'View Details',['class'=>'btn btn-info']) ?></td>
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