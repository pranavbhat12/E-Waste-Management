<?php include('header_service.php'); ?>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="container">
	  <br><br>
	  <br> 
	  <?php if($feedback = $this->session->flashdata('feedback')): ?> 
	  	<?php $class = $this->session->flashdata('class');?>   
		<div class="row">
			<div class="col-lg-6">
				 <div class="alert alert-dismissible alert-<?php echo $class; ?>">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong></strong> <a href="#" class="alert-link">
				  	<?= $feedback ?>
				  </a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<br>
	<div class="jumbotron">
	  <h1 class="display-3">Welcome <?= $name->cname ?>!</h1>
	  <p class="lead">Welcome to EWM, A web applications which allows you to buy refurbished products from the most entrusted sellers. It also provides you an opportunity to save the planet by recycling your E-waste in an organised and transperent way</p>
	  <hr class="my-4">
	  <br>
	  <?= anchor("service/editProfile",'Edit Profile',['class'=>'btn btn-warning']);?> 
	  <p class="lead">
	  </p>
	</div>
	<br>
	<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-12">
      <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 rounded bg-green-50 text-green-500 text-xs font-medium tracking-widest">CATEGORY</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-3 mb-4">Recent Items Sold</h2>
		<?php $count=0;?>
        <p class="leading-relaxed mb-1"><?php foreach($orders as $orders): ?>
				<p><?= ++$count ?>&nbsp;&nbsp;<?= $orders->p_name?>&nbsp;&nbsp;₹<?= $orders->amount ?>&nbsp;&nbsp;<?= date('d M y H:i:s',strtotime($orders->date)) ?></p>
				
		<?php endforeach; ?></p>
        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
          <a class="text-green-500 inline-flex items-center" href="historyProducts">See More
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
          
        </div>
   
      </div>
      <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 rounded bg-green-50 text-green-500 text-xs font-medium tracking-widest">CATEGORY</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-3 mb-4">Recent Serviced Products</h2>
		<?php $count=0; ?>
        <p class="leading-relaxed mb-1">	<?php foreach($serviced as $serviced): ?>
			
				<p><?= ++$count ?>&nbsp;&nbsp;<?= $serviced->e_name?>&nbsp;&nbsp;<?= date('d M y H:i:s',strtotime($serviced->date)) ?>&nbsp;&nbsp;<?= anchor("service/servicedProductDetails/{$serviced->e_id}",'View Details',['class'=>'btn btn-info']);?></p><br>
		<?php endforeach; ?></p>
	<br>
        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
          <a class="text-green-500 inline-flex items-center" href="servicedProducts">See More
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
         
        </div>
        
      </div>
    </div>
  </div>
</section>

<div class="row">
<h1 style="font-size:60px;">Recent Requests</h1>
<a href="requestPage" style="margin-left:1200px; ">See More>></a>

<?php
 
   if(!empty($request))
   {
	foreach($request as $row)
	{
	  
 ?>
<div class="col-4" style="margin-bottom: 50px;">
		<div class="row">
			<div class="mycol4">
				<p>Device Type:<strong> <?php echo $row->e_type; ?> </strong></p>
				<p>Date:<strong> <?php echo $row->date; ?> </strong></p>
				<p>Quantity:<strong><?php echo $row->e_quantity; ?></strong></p>
			</div>
			<div class="col-4" style="margin-right: 10px;">
				<img src=<?= $row->e_img ?> alt="" height="135px" width="135px">
			</div>
		</div>
		<div>
		   <?php $option=1 ?>
		  <div >   <?= anchor("service/productDetails/{$row->e_id}/{$option}",'More Details',['class'=>'btn btn-info' ]);?>   </div>
			<br>
		   <form action="<?= base_url('service/accept') ?>" method="post">
		   
		  
			<!--  <form action="<?= base_url('service/accept') ?>" method="post"> -->
	   

			<input type="hidden" id="accept" name="hiddenAccept" value="<?= $row->e_id ?>">

			<input type="submit" name="accept"  class="btn btn-primary"  value="Accept" />      
						 
			

		</form>
		</div>
	
</div>

<?php
}
}
?>
</div>
<!--this is in div row -->
</div>

	

</div> 
<?php include('footer.php'); ?>