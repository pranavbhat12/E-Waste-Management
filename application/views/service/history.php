<?php include('header_service.php');?>
<div class="container">
	<br>
	  <ol class="breadcrumb" style="width: 400px;">
	        <li class="breadcrumb-item"><a href="#">Service</a></li>
	        <li class="breadcrumb-item"><a href="#">Profile</a></li>
	        <li class="breadcrumb-item active">History of Sold Products</li>
	 </ol>
	 <br>
	 <h2 class="text-primary">Sold Products</h2>
	    <br>
	    <br>
	    <table class="table">
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th>Order Id</th>
				<th>Product Name</th>
				<th>Amount</th>
				<th>Date</th>
				<th>Details</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($orders)): ?>
			<?php $count = $this->uri->segment(3)?>
			<?php foreach($orders as $orders): ?>
		  <?php if($orders->Tracking=="Delivered"){
          ?>
			<tr>
				<td><?= ++$count ?></td>
				<td><?= $orders->o_id ?></td>
				<td><?= $orders->p_name?></td>
				<td>₹<?= $orders->amount ?></td>
				<td><?= date('d M y H:i:s',strtotime($orders->date)) ?></td>
				<td><?= anchor("service/moreInfoSold/{$orders->p_id}/0",'View Details',['class'=>'btn btn-info']);?></td>
			</tr>
		<?php } endforeach; ?>
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